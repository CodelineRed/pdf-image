<?php

namespace PdfImage;

use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\JsonFileLoader;

class Bootstrap {
    protected $translator;

    /**
     * Gets the parameter from the uri
     * 
     * @return string
     */
    public function getParam(): string
    {
        $param = 'index';
        $uri = explode('/', $_SERVER['REQUEST_URI']);

        foreach ($uri as $key => $value) {
            if ($uri[$key] != '' && is_readable(PDFIMAGE_VIEW . $uri[$key] . '.phtml')) {
                $param = strtolower($uri[$key]);
                break;
            }            
        }

        return $param;
    }

    /**
     * Initialize the application
     * Start the session and set error reporting
     */
    public function __construct()
    {
        $lang = 'en';
        session_start();
        error_reporting(PDFIMAGE_ERROR_REPORTING);

        if (!empty($_COOKIE['lang'])) {
            $lang = $_COOKIE['lang'];
        }

        $this->translator = new Translator($lang);
        $this->translator->setFallbackLocales(['en']);
        $this->translator->addLoader('json', new JsonFileLoader());
        $this->translator->addResource('json', PDFIMAGE_APP . '/lang/en.json', 'en');
        $this->translator->addResource('json', PDFIMAGE_APP . '/lang/de.json', 'de');
    }

    /**
     * Returns translation by $id or $id it self
     * 
     * @param string $id
     * @param array $parameters [optional]
     * @param string|null $domain [optional]
     * @param string|null $locale [optional]
     * @return string
     */
    public function trans(string $id, array $parameters = [], ?string $domain = null, ?string $locale = null): string
    {
        return $this->translator->trans($id, $parameters, $domain, $locale);
    }
}
