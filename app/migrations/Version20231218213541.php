<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231218213541 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE advertisement_images (id INT AUTO_INCREMENT NOT NULL, advertisement_id INT DEFAULT NULL, image VARCHAR(255) NOT NULL, base TINYINT(1) NULL, INDEX IDX_52DA5109A1FBF71B (advertisement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE advertisement_images ADD CONSTRAINT FK_52DA5109A1FBF71B FOREIGN KEY (advertisement_id) REFERENCES advertisement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE advertisement_images DROP FOREIGN KEY FK_52DA5109A1FBF71B');
        $this->addSql('DROP TABLE advertisement_images');
    }
}
