<?php

declare(strict_types=1);

namespace FiftyDeg\SyliusScriptsPlugin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\AbstractTranslation;

/**
 * @ORM\Entity()
 * @ORM\Table(name="fiftydeg_scripts_script_translation")
 */
class ScriptTranslation extends AbstractTranslation implements ScriptTranslationInterface
{
    /**
     * @ORM\Id
     *
     * @ORM\GeneratedValue
     *
     * @ORM\Column(type="integer")
     */
    protected int $id;

    public function getId(): int
    {
        return $this->id;
    }
}
