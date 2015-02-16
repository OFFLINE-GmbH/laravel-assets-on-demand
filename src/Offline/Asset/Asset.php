<?php namespace Offline\Asset;

/**
 * Class Asset
 * @package Offline\Asset
 */
/**
 * Class Asset
 * @package Offline\Asset
 */
class Asset
{
    /**
     * Registry config
     *
     * @var array
     */
    protected $assets;


    /**
     * Constructor
     *
     */
    public function __construct()
    {
        $this->assets = [];
    }

    /**
     * @param        $file
     * @param int    $priority
     * @param string $position
     *
     * @return \Offline\Asset\Asset
     */
    public function addCss($file, $priority = 0, $position = 'head')
    {
        $this->assets['css'][] = ['file' => $file, 'priority' => $priority, 'position' => $position];
        return $this;
    }

    /**
     * @param        $file
     * @param int    $priority
     * @param string $position
     *
     * @return \Offline\Asset\Asset
     */
    public function addImport($file, $priority = 0, $position = 'head')
    {
        $this->assets['import'][] = ['file' => $file, 'priority' => $priority, 'position' => $position];
        return $this;
    }

    /**
     * @param        $file
     * @param int    $priority
     * @param string $position
     *
     * @return \Offline\Asset\Asset
     */
    public function addJs($file, $priority = 0, $position = 'head')
    {
        $this->assets['js'][] = ['file' => $file, 'priority' => $priority, 'position' => $position];
        return $this;
    }

    /**
     * @param string $position
     *
     * @return string
     */
    public function all($position = 'head')
    {
        return $this->linkCss($position) . $this->linkJs($position) . $this->linkImport($position);
    }

    /**
     * @param string $position
     *
     * @return string
     */
    private function linkCss($position = 'head')
    {
        if (!array_key_exists('css', $this->assets)) {
            return '';
        }
        $this->sortAssetsByPriority();
        $html = [];
        foreach ($this->assets['css'] as $css) {
            if ($css['position'] == $position) {
                $html[] = '<link rel="stylesheet" href="' . asset($css['file']) . '" />';
            }
        }
        return implode("\n", $html) . "\n";
    }

    /**
     * @param string $position
     *
     * @return string
     */
    private function linkImport($position = 'head')
    {
        if (!array_key_exists('import', $this->assets)) {
            return '';
        }
        $this->sortAssetsByPriority();
        $html = [];
        foreach ($this->assets['import'] as $import) {
            if ($import['position'] == $position) {
                $html[] = '<link rel="import" href="' . asset($import['file']) . '" />';
            }
        }
        return implode("\n", $html) . "\n";
    }

    /**
     * @param string $position
     *
     * @return string
     */
    private function linkJs($position = 'head')
    {
        if (!array_key_exists('js', $this->assets)) {
            return '';
        }
        $this->sortAssetsByPriority();
        $html = [];
        foreach ($this->assets['js'] as $js) {
            if ($js['position'] == $position) {
                $html[] = '<script src="' . asset($js['file']) . '"></script>';
            }
        }
        return implode("\n", $html) . "\n";
    }

    /**
     * Sorts the assets by priority key
     * @return void
     */
    private function sortAssetsByPriority()
    {
        foreach (['css', 'js', 'import'] as $key) {
            if (array_key_exists($key, $this->assets)) {
                $this->assets[$key] = array_values(array_sort($this->assets[$key], function ($value) {
                    return $value['priority'];
                }));
            }
        }
    }

    /**
     * Returns all css for $position
     *
     * @return string
     */
    public function css($position = 'head')
    {
        return $this->linkCss($position);
    }

    /**
     * Returns all js for $position
     *
     * @return string
     */
    public function js($position = 'head')
    {
        return $this->linkJs($position);
    }

    /**
     * Returns all imports for $position
     *
     * @return string
     */
    public function import($position = 'head')
    {
        return $this->linkImport($position);
    }


}
