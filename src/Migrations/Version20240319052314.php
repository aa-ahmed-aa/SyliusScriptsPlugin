<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240319052314 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fiftydeg_scripts_script (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiftydeg_scripts_script_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT NOT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_29029F4A2C2AC5D3 (translatable_id), UNIQUE INDEX fiftydeg_scripts_script_translation_uniq_trans (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fiftydeg_scripts_script_translation ADD CONSTRAINT FK_29029F4A2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES fiftydeg_scripts_script (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE messenger_messages CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE available_at available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE delivered_at delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiftydeg_scripts_script_translation DROP FOREIGN KEY FK_29029F4A2C2AC5D3');
        $this->addSql('DROP TABLE fiftydeg_scripts_script');
        $this->addSql('DROP TABLE fiftydeg_scripts_script_translation');
        $this->addSql('ALTER TABLE messenger_messages CHANGE created_at created_at DATETIME NOT NULL, CHANGE available_at available_at DATETIME NOT NULL, CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }
}
