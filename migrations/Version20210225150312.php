<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210225150312 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD make_by_id INT DEFAULT NULL, ADD do_at DATETIME NOT NULL, ADD is_confirme TINYINT(1) DEFAULT NULL, ADD is_deliver TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D4999C0C5 FOREIGN KEY (make_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D4999C0C5 ON commande (make_by_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D4999C0C5');
        $this->addSql('DROP INDEX IDX_6EEAA67D4999C0C5 ON commande');
        $this->addSql('ALTER TABLE commande DROP make_by_id, DROP do_at, DROP is_confirme, DROP is_deliver');
    }
}
