<?php

namespace AppBundle\Command;

use AppBundle\Exchange\Adapter\ProviderInterface;
use AppBundle\Exchange\ExchangeAdapter;
use AppBundle\Service\ExchangeService;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;

class FetchExchangeInfoCommand extends ContainerAwareCommand
{
    /**
     * @var string|null The default command name
     */
    protected static $defaultName = 'app:fetch-exchange-info';

    /**
     * @var ExchangeService
     */
    protected $exchangeService;

    /**
     * FetchExchangeInfoCommand constructor.
     * @param ExchangeService $exchangeService
     */
    public function __construct(ExchangeService $exchangeService)
    {
        parent::__construct();

        $this->exchangeService = $exchangeService;
    }

    protected function configure()
    {
        $this->setDescription('Fetches exchange information(s) from providers');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $data = [];

        /** @var ProviderInterface $provider */
        foreach ($this->getProviders() as $provider) {
            $adapter = new ExchangeAdapter($provider);

            $data = array_merge($data, $this->exchangeService->batchProcess($adapter));
        }

        // TODO: Check data is empty and set output empty message
        $output->writeln(sprintf('All exchange rates collected from %s.', implode(', ', array_keys($data))));
    }

    private function getProviders(): array
    {
        $adapterDir = $this->getAdapterDir();

        $finder = new Finder();
        $finder->files()->in($adapterDir);

        $providers = [];
        $prefix = 'AppBundle\\Exchange\\Adapter';
        foreach ($finder as $file) {
            $ns = $prefix;
            if ($relativePath = $file->getRelativePath()) {
                $ns .= '\\'.strtr($relativePath, '/', '\\');
            }

            $r = new \ReflectionClass($ns.'\\'.$file->getBasename('.php'));
            if ($r->isSubclassOf('AppBundle\Exchange\\Adapter\\AbstractProvider')
                && !$r->isAbstract()
                && !$r->isInterface()
            ) {
                $providers[] = $r->newInstance();
            }
        }

        return $providers;
    }

    private function getAdapterDir(): string
    {
        $adapterDir = $this->getContainer()->get('kernel')->getProjectDir().'/src/AppBundle/Exchange/Adapter';

        return $adapterDir;
    }
}
