<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210226161011 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D1EBAF6CC');
        $this->addSql('DROP INDEX IDX_6EEAA67D1EBAF6CC ON commande');
        $this->addSql('ALTER TABLE commande DROP articles_id');
        $this->addSql('ALTER TABLE commande_article ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande_article ADD CONSTRAINT FK_F4817CC682EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_F4817CC682EA2E54 ON commande_article (commande_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD articles_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D1EBAF6CC FOREIGN KEY (articles_id) REFERENCES commande_article (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_6EEAA67D1EBAF6CC ON commande (articles_id)');
        $this->addSql('ALTER TABLE commande_article DROP FOREIGN KEY FK_F4817CC682EA2E54');
        $this->addSql('DROP INDEX IDX_F4817CC682EA2E54 ON commande_article');
        $this->addSql('ALTER TABLE commande_article DROP commande_id');
    }
}
