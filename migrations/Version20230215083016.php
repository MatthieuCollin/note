<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230215083016 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE apprenants (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enseigne (id INT AUTO_INCREMENT NOT NULL, formateur_id INT DEFAULT NULL, INDEX IDX_37D4778E155D8F51 (formateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formateurs (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formations (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formations_matieres (formations_id INT NOT NULL, matieres_id INT NOT NULL, INDEX IDX_3C4B85313BF5B0C2 (formations_id), INDEX IDX_3C4B853182350831 (matieres_id), PRIMARY KEY(formations_id, matieres_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matieres (id INT AUTO_INCREMENT NOT NULL, enseigne_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, programme LONGTEXT DEFAULT NULL, INDEX IDX_8D9773D26C2A0A71 (enseigne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notes (id INT AUTO_INCREMENT NOT NULL, apprenants_id INT NOT NULL, matière_id INT NOT NULL, note INT NOT NULL, INDEX IDX_11BA68CD4B7C9BD (apprenants_id), INDEX IDX_11BA68CB25992FD (matière_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE suivre (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE suivre_formations (suivre_id INT NOT NULL, formations_id INT NOT NULL, INDEX IDX_5F1A124E1E283B1C (suivre_id), INDEX IDX_5F1A124E3BF5B0C2 (formations_id), PRIMARY KEY(suivre_id, formations_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE suivre_apprenants (suivre_id INT NOT NULL, apprenants_id INT NOT NULL, INDEX IDX_D8961AFB1E283B1C (suivre_id), INDEX IDX_D8961AFBD4B7C9BD (apprenants_id), PRIMARY KEY(suivre_id, apprenants_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tuteurs (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE enseigne ADD CONSTRAINT FK_37D4778E155D8F51 FOREIGN KEY (formateur_id) REFERENCES formateurs (id)');
        $this->addSql('ALTER TABLE formations_matieres ADD CONSTRAINT FK_3C4B85313BF5B0C2 FOREIGN KEY (formations_id) REFERENCES formations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formations_matieres ADD CONSTRAINT FK_3C4B853182350831 FOREIGN KEY (matieres_id) REFERENCES matieres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE matieres ADD CONSTRAINT FK_8D9773D26C2A0A71 FOREIGN KEY (enseigne_id) REFERENCES enseigne (id)');
        $this->addSql('ALTER TABLE notes ADD CONSTRAINT FK_11BA68CD4B7C9BD FOREIGN KEY (apprenants_id) REFERENCES apprenants (id)');
        $this->addSql('ALTER TABLE notes ADD CONSTRAINT FK_11BA68CB25992FD FOREIGN KEY (matière_id) REFERENCES matieres (id)');
        $this->addSql('ALTER TABLE suivre_formations ADD CONSTRAINT FK_5F1A124E1E283B1C FOREIGN KEY (suivre_id) REFERENCES suivre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE suivre_formations ADD CONSTRAINT FK_5F1A124E3BF5B0C2 FOREIGN KEY (formations_id) REFERENCES formations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE suivre_apprenants ADD CONSTRAINT FK_D8961AFB1E283B1C FOREIGN KEY (suivre_id) REFERENCES suivre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE suivre_apprenants ADD CONSTRAINT FK_D8961AFBD4B7C9BD FOREIGN KEY (apprenants_id) REFERENCES apprenants (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE enseigne DROP FOREIGN KEY FK_37D4778E155D8F51');
        $this->addSql('ALTER TABLE formations_matieres DROP FOREIGN KEY FK_3C4B85313BF5B0C2');
        $this->addSql('ALTER TABLE formations_matieres DROP FOREIGN KEY FK_3C4B853182350831');
        $this->addSql('ALTER TABLE matieres DROP FOREIGN KEY FK_8D9773D26C2A0A71');
        $this->addSql('ALTER TABLE notes DROP FOREIGN KEY FK_11BA68CD4B7C9BD');
        $this->addSql('ALTER TABLE notes DROP FOREIGN KEY FK_11BA68CB25992FD');
        $this->addSql('ALTER TABLE suivre_formations DROP FOREIGN KEY FK_5F1A124E1E283B1C');
        $this->addSql('ALTER TABLE suivre_formations DROP FOREIGN KEY FK_5F1A124E3BF5B0C2');
        $this->addSql('ALTER TABLE suivre_apprenants DROP FOREIGN KEY FK_D8961AFB1E283B1C');
        $this->addSql('ALTER TABLE suivre_apprenants DROP FOREIGN KEY FK_D8961AFBD4B7C9BD');
        $this->addSql('DROP TABLE apprenants');
        $this->addSql('DROP TABLE enseigne');
        $this->addSql('DROP TABLE formateurs');
        $this->addSql('DROP TABLE formations');
        $this->addSql('DROP TABLE formations_matieres');
        $this->addSql('DROP TABLE matieres');
        $this->addSql('DROP TABLE notes');
        $this->addSql('DROP TABLE suivre');
        $this->addSql('DROP TABLE suivre_formations');
        $this->addSql('DROP TABLE suivre_apprenants');
        $this->addSql('DROP TABLE tuteurs');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
