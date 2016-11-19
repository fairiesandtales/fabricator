<?php

namespace AppBundle\Command;

use Doctrine\ORM\EntityManager;
use FairiesAndTales\Fixture;
use hanneskod\classtools\Iterator\ClassIterator;
use Sonata\BlockBundle\Command\BaseCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class EssentialsDumpCommand extends BaseCommand
{
    /** @var EntityManager */
    private $em;

    /**
     * EssentialsDumpCommand constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    /**
     * Configuring console command
     */
    protected function configure()
    {
        $this
            ->setName('fnt:essentials:dump')
            ->setDescription('Dump essentials from DB to YML in essentials/fixtures/')
            ->setHelp("Just run it, and commit changes carefully.")
            ->addArgument('fixture', InputArgument::OPTIONAL, 'The exact fixture you want to dump.')
        ;
    }

    /**
     * Executing the command which dump the essentials to files
     *
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @return int|null
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $io = new SymfonyStyle($input, $output);
            $finder = new Finder;
            $result = false;
            $iterator = new ClassIterator($finder->in('src/AppBundle/Entity'));
            $serializer = new Serializer(array(new GetSetMethodNormalizer()));

            $fixture = $input->getArgument('fixture') ? ucfirst($input->getArgument('fixture')) : null;
            $io->title('Dumping FnT essentials' . ($fixture ? " ($fixture)" : ''));

            $entityClasses = [];
            foreach ($iterator->getClassMap() as $className => $splFileInfo) {
                if (empty($fixture) || "AppBundle\\Entity\\".$fixture == $className) {
                    $entityClasses[] = $className;
                }
            }

            $io->section('Entities');

            foreach ($entityClasses as $entityClass) {
                $io->text($entityClass);

                $data = $this->em->getRepository($entityClass)->findAll();
                $io->progressStart(count($data));

                $dump = [];
                foreach ($data as $d) {
                    $dump[str_replace(" ", "_", strtolower($d))] = $serializer->normalize($d);
                    $io->progressAdvance();
                }

                $class = new \ReflectionClass($entityClass);
                $result = Fixture::set($class->getShortName(), $dump);

                $io->progressFinish();

                if (!$result) {
                    break;
                }
            }
        } catch (\Exception $exception) {
            throw $exception;
        }

        // Result is not verbose yet. Fails after trying to dump the fixture
        $result ? $io->success('Done!') : $io->error('Fail!');

        return $result;
    }
}