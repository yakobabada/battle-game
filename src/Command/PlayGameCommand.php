<?php

namespace App\Command;

use App\Entity\Combatant;
use App\Factory\CombatantFactory;
use App\Util\CombatantTurnUtil;
use App\Util\BattleUtil;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class PlayGameCommand extends Command
{
    /**
     * @var BattleUtil
     */
    private $battleUtil;
    /**
     * @var CombatantTurnUtil
     */
    private $combatantTurnUtil;

    public function __construct(BattleUtil $battleUtil, CombatantTurnUtil $combatantTurnUtil)
    {
        $this->battleUtil = $battleUtil;
        $this->combatantTurnUtil = $combatantTurnUtil;

        parent::__construct(null);
    }

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
            ->setName('app:play-game')
            ->addArgument('first-combatant', InputArgument::REQUIRED, 'The name of the first combatant.')
            ->addArgument('second-combatant', InputArgument::REQUIRED, 'The name of the second combatant.')
            ->setDescription('Play game.');
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $combatantFactory = new CombatantFactory();

        $firstCombatant = $combatantFactory->create(
            Combatant::TYPES[array_rand(Combatant::TYPES)],
            $input->getArgument('first-combatant')
        );
        $secondCombatant = $combatantFactory->create(
            Combatant::TYPES[array_rand(Combatant::TYPES)],
            $input->getArgument('second-combatant')
        );

        $opponents = $this->combatantTurnUtil->getOpponents($firstCombatant, $secondCombatant);

        $output->writeln([
            'Start',
            '============',
            '',
        ]);

        for ($i=1;$i<=30;$i++) {
            $output->writeln([
                'round number: ' . $i,
                '',
            ]);

            $output->writeln([
                'Attacker: ' . $opponents['attacker']->getName() . ' with health: ' . $opponents['attacker']->getHealth(),
                'Defender: ' . $opponents['defender']->getName() . ' with health: ' . $opponents['defender']->getHealth(),
                ''
            ]);

            $this->battleUtil->play(
                $opponents['attacker'],
                $opponents['defender']
            );

            if (!$opponents['defender']->isAlive()) {
                break;
            }

            if (!$this->battleUtil->stopSwap($opponents['attacker'])) {
                $opponents = $this->combatantTurnUtil->getNext($opponents['attacker'], $opponents['defender']);
            }
        }

        if (!$opponents['defender']->isAlive()) {
            $output->writeln([
                '🙃 The winner is: ' . $opponents['attacker']->getName() . ' 🙃',
                '🤐 The loser is: ' . $opponents['defender']->getName() . ' 🤐'
            ]);

            return;
        }

        $output->writeln([
            'No one won in this battle'
        ]);
    }
}