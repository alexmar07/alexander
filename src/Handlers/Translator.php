<?php namespace AlexDev\Alexander\Handlers;

use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\Translation\Translator as SymfonyTranslator;

/**
 * Translator for application
 *
 * @extends Symfony\Component\Translation\Translator
 *
 * @author Alessandro Marotta <alessand.marotta@gmail.com>
 */
class Translator extends SymfonyTranslator {

    //-----------------------------------------------------------------------

    /**
     * Construct
     *
     */
    public function __construct() {

        parent::__construct(getenv('APP_LOCALE'));

        $this->load();
    }

    //-----------------------------------------------------------------------

    /**
     * Load current lang translation
     *
     * @return void
     */
    protected function load () : void {

        $this->addLoader('array', new ArrayLoader);

        $pathLang = resource_path().'/lang/'.$this->getLocale().'/';

        foreach (array_diff(scandir($pathLang), array('.', '..')) as $file) {
            $this->addResource('array', require $pathLang.$file, $this->getLocale());
        }

    }

    //-----------------------------------------------------------------------
}