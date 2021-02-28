<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210226161540 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE arcticle_commande (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, qte INT NOT NULL, UNIQUE INDEX UNIQ_D863BA787294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, prix INT NOT NULL, photo VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_categorie (article_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_934886107294869C (article_id), INDEX IDX_93488610BCF5E72D (categorie_id), PRIMARY KEY(article_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE banier_image (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, make_by_id INT DEFAULT NULL, prix INT NOT NULL, confirme_at DATETIME DEFAULT NULL, do_at DATETIME NOT NULL, is_confirme TINYINT(1) DEFAULT NULL, is_deliver TINYINT(1) DEFAULT NULL, is_out TINYINT(1) DEFAULT NULL, INDEX IDX_6EEAA67D4999C0C5 (make_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_article (id INT AUTO_INCREMENT NOT NULL, article_id INT DEFAULT NULL, commande_id INT DEFAULT NULL, qte INT NOT NULL, UNIQUE INDEX UNIQ_F4817CC67294869C (article_id), INDEX IDX_F4817CC682EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, sujet VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, is_read TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, media_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, begin_at DATETIME DEFAULT NULL, poster VARCHAR(255) NOT NULL, prix INT DEFAULT NULL, UNIQUE INDEX UNIQ_404021BFEA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_video (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, prix BIGINT NOT NULL, fichier VARCHAR(255) NOT NULL, poster VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE galery (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, formation_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, whatsapp INT DEFAULT NULL, tel INT DEFAULT NULL, INDEX IDX_5E90F6D65200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, create_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note_article (id INT AUTO_INCREMENT NOT NULL, auteur_id INT DEFAULT NULL, article_id INT NOT NULL, note INT NOT NULL, commentaire LONGTEXT DEFAULT NULL, INDEX IDX_839CCAFC60BB6FE6 (auteur_id), INDEX IDX_839CCAFC7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, message LONGTEXT NOT NULL, state TINYINT(1) DEFAULT NULL, titre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_24CC0DF2A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, panier_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, numero VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', UNIQUE INDEX UNIQ_8D93D649F77D927C (panier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE arcticle_commande ADD CONSTRAINT FK_D863BA787294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE article_categorie ADD CONSTRAINT FK_934886107294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_categorie ADD CONSTRAINT FK_93488610BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D4999C0C5 FOREIGN KEY (make_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commande_article ADD CONSTRAINT FK_F4817CC67294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE commande_article ADD CONSTRAINT FK_F4817CC682EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BFEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D65200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE note_article ADD CONSTRAINT FK_839CCAFC60BB6FE6 FOREIGN KEY (auteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE note_article ADD CONSTRAINT FK_839CCAFC7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE arcticle_commande DROP FOREIGN KEY FK_D863BA787294869C');
        $this->addSql('ALTER TABLE article_categorie DROP FOREIGN KEY FK_934886107294869C');
        $this->addSql('ALTER TABLE commande_article DROP FOREIGN KEY FK_F4817CC67294869C');
        $this->addSql('ALTER TABLE note_article DROP FOREIGN KEY FK_839CCAFC7294869C');
        $this->addSql('ALTER TABLE article_categorie DROP FOREIGN KEY FK_93488610BCF5E72D');
        $this->addSql('ALTER TABLE commande_article DROP FOREIGN KEY FK_F4817CC682EA2E54');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D65200282E');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BFEA9FDD75');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F77D927C');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D4999C0C5');
        $this->addSql('ALTER TABLE note_article DROP FOREIGN KEY FK_839CCAFC60BB6FE6');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF2A76ED395');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE arcticle_commande');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_categorie');
        $this->addSql('DROP TABLE banier_image');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commande_article');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE formation_video');
        $this->addSql('DROP TABLE galery');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE note_article');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE user');
    }
}
