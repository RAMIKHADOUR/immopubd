<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241112104932 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresses (id INT AUTO_INCREMENT NOT NULL, numero_voie INT NOT NULL, voie VARCHAR(255) NOT NULL, type_voie VARCHAR(100) NOT NULL, ville VARCHAR(100) NOT NULL, code_postale VARCHAR(255) NOT NULL, region VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annonces (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(100) DEFAULT NULL, reference VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_CB988C6FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorysbien (id INT AUTO_INCREMENT NOT NULL, categorie VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contacts (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, email VARCHAR(180) NOT NULL, message LONGTEXT NOT NULL, tel_mobile VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE info_perso (id INT AUTO_INCREMENT NOT NULL, civilite VARCHAR(50) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, email VARCHAR(255) NOT NULL, tele_fixe VARCHAR(255) DEFAULT NULL, tele_mobile VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medias (id INT AUTO_INCREMENT NOT NULL, annonce_id INT DEFAULT NULL, file_path VARCHAR(255) DEFAULT NULL, updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_12D2AF818805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prices (id INT AUTO_INCREMENT NOT NULL, prix DOUBLE PRECISION NOT NULL, type_property VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE propertys (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, typebien_id INT DEFAULT NULL, adresse_id INT DEFAULT NULL, infosperso_id INT DEFAULT NULL, annonce_id INT DEFAULT NULL, description LONGTEXT NOT NULL, surface DOUBLE PRECISION NOT NULL, chambres INT NOT NULL, sallebains INT NOT NULL, etages INT NOT NULL, numero_etage INT NOT NULL, internet TINYINT(1) NOT NULL, garage TINYINT(1) NOT NULL, piscine TINYINT(1) NOT NULL, camera TINYINT(1) NOT NULL, INDEX IDX_7AEEC2C412469DE2 (category_id), INDEX IDX_7AEEC2C4677134B4 (typebien_id), UNIQUE INDEX UNIQ_7AEEC2C44DE7DC5C (adresse_id), UNIQUE INDEX UNIQ_7AEEC2C461D1EAC4 (infosperso_id), UNIQUE INDEX UNIQ_7AEEC2C48805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE typesbien (id INT AUTO_INCREMENT NOT NULL, type_bien VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, email VARCHAR(180) NOT NULL, tele_mobile VARCHAR(255) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6FA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE medias ADD CONSTRAINT FK_12D2AF818805AB2F FOREIGN KEY (annonce_id) REFERENCES annonces (id)');
        $this->addSql('ALTER TABLE propertys ADD CONSTRAINT FK_7AEEC2C412469DE2 FOREIGN KEY (category_id) REFERENCES categorysbien (id)');
        $this->addSql('ALTER TABLE propertys ADD CONSTRAINT FK_7AEEC2C4677134B4 FOREIGN KEY (typebien_id) REFERENCES typesbien (id)');
        $this->addSql('ALTER TABLE propertys ADD CONSTRAINT FK_7AEEC2C44DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresses (id)');
        $this->addSql('ALTER TABLE propertys ADD CONSTRAINT FK_7AEEC2C461D1EAC4 FOREIGN KEY (infosperso_id) REFERENCES info_perso (id)');
        $this->addSql('ALTER TABLE propertys ADD CONSTRAINT FK_7AEEC2C48805AB2F FOREIGN KEY (annonce_id) REFERENCES annonces (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6FA76ED395');
        $this->addSql('ALTER TABLE medias DROP FOREIGN KEY FK_12D2AF818805AB2F');
        $this->addSql('ALTER TABLE propertys DROP FOREIGN KEY FK_7AEEC2C412469DE2');
        $this->addSql('ALTER TABLE propertys DROP FOREIGN KEY FK_7AEEC2C4677134B4');
        $this->addSql('ALTER TABLE propertys DROP FOREIGN KEY FK_7AEEC2C44DE7DC5C');
        $this->addSql('ALTER TABLE propertys DROP FOREIGN KEY FK_7AEEC2C461D1EAC4');
        $this->addSql('ALTER TABLE propertys DROP FOREIGN KEY FK_7AEEC2C48805AB2F');
        $this->addSql('DROP TABLE adresses');
        $this->addSql('DROP TABLE annonces');
        $this->addSql('DROP TABLE categorysbien');
        $this->addSql('DROP TABLE contacts');
        $this->addSql('DROP TABLE info_perso');
        $this->addSql('DROP TABLE medias');
        $this->addSql('DROP TABLE prices');
        $this->addSql('DROP TABLE propertys');
        $this->addSql('DROP TABLE typesbien');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
