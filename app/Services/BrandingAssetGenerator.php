<?php

namespace App\Services;

use GdImage;
use InvalidArgumentException;

class BrandingAssetGenerator
{
    private const BG_R = 7;

    private const BG_G = 8;

    private const BG_B = 13;

    /** Roxo da marca (#6c63ff) para variante delivery na faixa inferior. */
    private const ACCENT_R = 108;

    private const ACCENT_G = 99;

    private const ACCENT_B = 255;

    public function __construct(
        private readonly string $logoPath,
        private readonly string $outputDir,
    ) {}

    public static function defaultPaths(): self
    {
        return new self(
            logoPath: storage_path('app/public/images/logo.png'),
            outputDir: public_path('images'),
        );
    }

    /**
     * Gera PNGs em public/images a partir do logo em storage.
     *
     * @return list<string> caminhos relativos a public/ dos arquivos escritos
     */
    public function generate(): array
    {
        if (! is_file($this->logoPath)) {
            throw new InvalidArgumentException('Logo não encontrado: '.$this->logoPath);
        }

        if (! is_dir($this->outputDir)) {
            if (! mkdir($this->outputDir, 0755, true) && ! is_dir($this->outputDir)) {
                throw new InvalidArgumentException('Não foi possível criar: '.$this->outputDir);
            }
        }

        $written = [];

        $written[] = $this->savePng($this->resizeTransparent(16, 16), 'favicon-16x16.png');
        $written[] = $this->savePng($this->resizeTransparent(32, 32), 'favicon-32x32.png');

        // Google Search exige ícone ≥48×48 e prioriza /favicon.ico na raiz (documentação Search Central).
        $icon48 = $this->squareOnBrandBackground(48);
        $png48 = $this->pngBinary($icon48);
        imagedestroy($icon48);
        $png48Path = $this->outputDir.DIRECTORY_SEPARATOR.'favicon-48x48.png';
        if (file_put_contents($png48Path, $png48) === false) {
            throw new InvalidArgumentException('Falha ao gravar: '.$png48Path);
        }
        $written[] = 'images/favicon-48x48.png';

        $icoPath = dirname($this->outputDir).DIRECTORY_SEPARATOR.'favicon.ico';
        $icoPayload = $this->wrapSinglePngAsIco($png48, 48, 48);
        if (file_put_contents($icoPath, $icoPayload) === false) {
            throw new InvalidArgumentException('Falha ao gravar: '.$icoPath);
        }
        $written[] = 'favicon.ico';

        $written[] = $this->savePng($this->squareOnBrandBackground(180), 'apple-touch-icon.png');
        $written[] = $this->savePng($this->squareOnBrandBackground(192), 'android-chrome-192x192.png');
        $written[] = $this->savePng($this->squareOnBrandBackground(512), 'android-chrome-512x512.png');

        $written[] = $this->savePng($this->openGraphCanvas(accentBottom: false), 'og-arcn.png');
        $written[] = $this->savePng($this->openGraphCanvas(accentBottom: true), 'og-delivery.png');

        return $written;
    }

    private function loadLogo(): GdImage
    {
        $info = @getimagesize($this->logoPath);
        if ($info === false) {
            throw new InvalidArgumentException('Arquivo de logo inválido.');
        }

        $mime = $info['mime'] ?? '';

        $img = match ($mime) {
            'image/png' => imagecreatefrompng($this->logoPath),
            'image/jpeg' => imagecreatefromjpeg($this->logoPath),
            'image/webp' => imagecreatefromwebp($this->logoPath),
            default => throw new InvalidArgumentException('Formato não suportado: '.$mime.'. Use PNG, JPEG ou WebP.'),
        };

        if ($img === false) {
            throw new InvalidArgumentException('Falha ao decodificar o logo.');
        }

        return $img;
    }

    private function resizeTransparent(int $targetW, int $targetH): GdImage
    {
        $src = $this->loadLogo();
        $this->preserveAlpha($src);

        $sw = imagesx($src);
        $sh = imagesy($src);

        $dst = imagecreatetruecolor($targetW, $targetH);
        imagealphablending($dst, false);
        imagesavealpha($dst, true);
        $transparent = imagecolorallocatealpha($dst, 0, 0, 0, 127);
        imagefilledrectangle($dst, 0, 0, $targetW, $targetH, $transparent);
        imagealphablending($dst, true);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $targetW, $targetH, $sw, $sh);
        imagedestroy($src);

        imagesavealpha($dst, true);

        return $dst;
    }

    private function squareOnBrandBackground(int $size): GdImage
    {
        $dst = imagecreatetruecolor($size, $size);
        imagealphablending($dst, true);
        $bg = imagecolorallocate($dst, self::BG_R, self::BG_G, self::BG_B);
        imagefilledrectangle($dst, 0, 0, $size, $size, $bg);

        $src = $this->loadLogo();
        $this->preserveAlpha($src);

        $pad = (int) round($size * 0.14);
        $maxW = $size - 2 * $pad;
        $maxH = $size - 2 * $pad;
        $sw = imagesx($src);
        $sh = imagesy($src);
        $scale = min($maxW / $sw, $maxH / $sh);
        $tw = max(1, (int) round($sw * $scale));
        $th = max(1, (int) round($sh * $scale));
        $ox = (int) (($size - $tw) / 2);
        $oy = (int) (($size - $th) / 2);

        imagecopyresampled($dst, $src, $ox, $oy, 0, 0, $tw, $th, $sw, $sh);
        imagedestroy($src);

        return $dst;
    }

    private function openGraphCanvas(bool $accentBottom): GdImage
    {
        $cw = 1200;
        $ch = 630;

        $dst = imagecreatetruecolor($cw, $ch);
        imagealphablending($dst, true);
        $bg = imagecolorallocate($dst, self::BG_R, self::BG_G, self::BG_B);
        imagefilledrectangle($dst, 0, 0, $cw, $ch, $bg);

        $src = $this->loadLogo();
        $this->preserveAlpha($src);

        $sw = imagesx($src);
        $sh = imagesy($src);
        $maxLogoW = (int) ($cw * 0.52);
        $maxLogoH = (int) ($ch * 0.52);
        $scale = min($maxLogoW / $sw, $maxLogoH / $sh);
        $tw = max(1, (int) round($sw * $scale));
        $th = max(1, (int) round($sh * $scale));
        $ox = (int) (($cw - $tw) / 2);
        $oy = (int) (($ch - $th) / 2);

        imagecopyresampled($dst, $src, $ox, $oy, 0, 0, $tw, $th, $sw, $sh);
        imagedestroy($src);

        if ($accentBottom) {
            imagealphablending($dst, true);
            $accent = imagecolorallocatealpha($dst, self::ACCENT_R, self::ACCENT_G, self::ACCENT_B, 75);
            imagefilledrectangle($dst, 0, (int) ($ch * 0.82), $cw, $ch, $accent);
        }

        return $dst;
    }

    private function preserveAlpha(GdImage $img): void
    {
        imagealphablending($img, false);
        imagesavealpha($img, true);
    }

    /** PNG compactado em string (para embutir em .ico). */
    private function pngBinary(GdImage $img): string
    {
        imagesavealpha($img, true);
        ob_start();
        imagepng($img, null, 6);
        $bin = ob_get_clean();
        if ($bin === false || $bin === '') {
            throw new InvalidArgumentException('Falha ao codificar PNG.');
        }

        return $bin;
    }

    /**
     * Um único frame ICO contendo PNG (suportado desde Windows Vista — compatível com crawlers modernos).
     */
    private function wrapSinglePngAsIco(string $pngBinary, int $width, int $height): string
    {
        $len = strlen($pngBinary);
        $offset = 22;
        $wByte = $width >= 256 ? 0 : $width;
        $hByte = $height >= 256 ? 0 : $height;

        $header = pack('vvv', 0, 1, 1);
        $entry = pack('CC', $wByte, $hByte)
            .pack('CC', 0, 0)
            .pack('v', 1)
            .pack('v', 0)
            .pack('V', $len)
            .pack('V', $offset);

        return $header.$entry.$pngBinary;
    }

    private function savePng(GdImage $img, string $filename): string
    {
        $path = $this->outputDir.DIRECTORY_SEPARATOR.$filename;
        imagesavealpha($img, true);
        if (! imagepng($img, $path, 6)) {
            imagedestroy($img);
            throw new InvalidArgumentException('Falha ao gravar: '.$path);
        }
        imagedestroy($img);

        return 'images/'.$filename;
    }
}
