<?php

namespace SpeckSearch\Service;

class Search
{
    protected $moduleOptions;

    public function search($terms, array $options=null, array $moduleOptions=null)
    {
        if ($options) {
            $this->mergeOptions($options);
        };

        if (is_string($terms)) {
        }

        if (is_array($terms)) {
        }
    }

    public function mergeOptions(array $options)
    {
        $configFiles = array(
            __DIR__ . '/config/module.config.php',
        );
        foreach($configFiles as $configFile) {
            $this->options = \Zend\Stdlib\ArrayUtils::merge($this->getOptions(), include $configFile);
        }
    }

    /**
     * @return moduleOptions
     */
    public function getModuleOptions()
    {
        return $this->moduleOptions;
    }

    /**
     * @param $moduleOptions
     * @return self
     */
    public function setModuleOptions($moduleOptions)
    {
        $this->moduleOptions = $moduleOptions;
        return $this;
    }
}
