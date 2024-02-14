<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231218214013 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exchange_offers (id INT AUTO_INCREMENT NOT NULL, advertisement_id INT DEFAULT NULL, proposed_advertisement_id INT DEFAULT NULL, user_id BIGINT DEFAULT NULL, choosed TINYINT(1) NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_A25FFAC9A1FBF71B (advertisement_id), INDEX IDX_A25FFAC976113CDB (proposed_advertisement_id), INDEX IDX_A25FFAC9A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exchange_offers ADD CONSTRAINT FK_A25FFAC9A1FBF71B FOREIGN KEY (advertisement_id) REFERENCES advertisement (id)');
        $this->addSql('ALTER TABLE exchange_offers ADD CONSTRAINT FK_A25FFAC976113CDB FOREIGN KEY (proposed_advertisement_id) REFERENCES advertisement (id)');
        $this->addSql('ALTER TABLE exchange_offers ADD CONSTRAINT FK_A25FFAC9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exchange_offers DROP FOREIGN KEY FK_A25FFAC9A1FBF71B');
        $this->addSql('ALTER TABLE exchange_offers DROP FOREIGN KEY FK_A25FFAC976113CDB');
        $this->addSql('ALTER TABLE exchange_offers DROP FOREIGN KEY FK_A25FFAC9A76ED395');
        $this->addSql('DROP TABLE exchange_offers');
    }
}
