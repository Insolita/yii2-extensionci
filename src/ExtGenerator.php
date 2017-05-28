<?php
/**
 * Created by solly [24.05.17 12:28]
 */

namespace insolita\extensionci;

use yii\gii\CodeFile;
use yii\gii\generators\extension\Generator;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;

class ExtGenerator extends Generator
{
    public $templates = [
        'default'=>'@insolita/extensionci/templates/default',
        'nodb'=>'@insolita/extensionci/templates/nodb',
        'functional'=>'@insolita/extensionci/templates/functional',
    ];
    public $requiredFiles = [
        'src/AutoloadExample.php',
        'README.md',
        'composer.json',
    ];
    public $commonFiles = [
        'CHANGELOG.md',
        '_.gitattributes',
        '.gitignore',
        'codeception.yml',
        '.travis.yml',
        '.scrutinizer.yml',
        'docs/.gitkeep',
        'tests/unit/bootstrap.php',
        'tests/unit/AwesomeTest.php',
        'tests/.env',
        'tests/unit.suite.yml',
        'tests/yii',
        'tests/bootstrap.php',
        'tests/config/base.php',
        'tests/config/console.php',
    ];
    
    public $dbDepFiles = [
        'tests/migrations/mysql/.gitkeep',
        'tests/migrations/pg/.gitkeep',
    ];
    
    public $functionalFiles = [
        'tests/config/functional.php',
        'tests/functional/bootstrap.php',
        'tests/functional.suite.yml'
    ];
  
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'Advanced Extension Generator';
    }
    
    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        return 'This generator helps you to generate the files needed by a
        Yii extension with test infrastructure adapted for continuous integration';
    }
    
    /**
     * @inheritdoc
     */
    public function requiredTemplates()
    {
        return $this->requiredFiles;
    }
    
    /**
     * @inheritdoc
     */
    public function generate()
    {
        $files = [];
        $modulePath = $this->getOutputPath();
        $templates = $this->requiredTemplates();
        foreach ($templates as $path){
            $files[] = new CodeFile(
                $modulePath . '/' . $this->packageName . '/'.$path,
                $this->render($path)
            );
        }
        foreach ($this->commonFiles as $path){
            $targetPath = StringHelper::startsWith($path, '_')?ltrim($path,'_'):$path;
            $files[] = new CodeFile(
                $modulePath . '/' . $this->packageName . '/'.$targetPath,
                file_get_contents($this->templatePath.'/'.$path)
            );
        }
        if($this->template !== 'nodb'){
            foreach ($this->dbDepFiles as $path){
                $files[] = new CodeFile(
                    $modulePath . '/' . $this->packageName . '/'.$path,
                    file_get_contents($this->templatePath.'/'.$path)
                );
            }
        }
        if($this->template ==='functional'){
            foreach ($this->functionalFiles as $path){
                $files[] = new CodeFile(
                    $modulePath . '/' . $this->packageName . '/'.$path,
                    file_get_contents($this->templatePath.'/'.$path)
                );
            }
        }
        return $files;
    }
}
