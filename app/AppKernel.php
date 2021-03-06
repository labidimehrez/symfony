<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new MyApp\EspritBundle\MyAppEspritBundle(),
            new MyApp\UserBundle\MyAppUserBundle(),
            new MyApp\ForumBundle\MyAppForumBundle(),
            new MyApp\ArticleBundle\MyAppArticleBundle(),
            new Ivory\CKEditorBundle\IvoryCKEditorBundle(),
            new Twitter\BootstrapBundle\TwitterBootstrapBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Genemu\Bundle\FormBundle\GenemuFormBundle(),
            new FOS\RestBundle\FOSRestBundle(),
            new FOS\CommentBundle\FOSCommentBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle($this),
            new Knp\Bundle\TimeBundle\KnpTimeBundle(),
            new Craue\TwigExtensionsBundle\CraueTwigExtensionsBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new JMS\AopBundle\JMSAopBundle(),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new Avalanche\Bundle\ImagineBundle\AvalancheImagineBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
//            new Desarrolla2\Bundle\RSSClientBundle\RSSClientBundle(),
//	    new Juanber84\Bundle\ProfilercommandBundle\Juanber84ProfilercommandBundle(),	 
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Acme\DemoBundle\AcmeDemoBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
//            $bundles[] = new Elao\WebProfilerExtraBundle\WebProfilerExtraBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
