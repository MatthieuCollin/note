<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230322150958 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE apprenants (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, suivre_id INT NOT NULL, tutorat_id INT NOT NULL, UNIQUE INDEX UNIQ_C71C2982A76ED395 (user_id), INDEX IDX_C71C29821E283B1C (suivre_id), INDEX IDX_C71C29826C1DB1B6 (tutorat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enseigne (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enseigne_formateurs (enseigne_id INT NOT NULL, formateurs_id INT NOT NULL, INDEX IDX_692ADF256C2A0A71 (enseigne_id), INDEX IDX_692ADF25FB0881C8 (formateurs_id), PRIMARY KEY(enseigne_id, formateurs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enseigne_matieres (enseigne_id INT NOT NULL, matieres_id INT NOT NULL, INDEX IDX_EDA665A56C2A0A71 (enseigne_id), INDEX IDX_EDA665A582350831 (matieres_id), PRIMARY KEY(enseigne_id, matieres_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formateurs (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, UNIQUE INDEX UNIQ_FD80E574A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formations (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, id_matieres INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formations_matieres (formations_id INT NOT NULL, matieres_id INT NOT NULL, INDEX IDX_3C4B85313BF5B0C2 (formations_id), INDEX IDX_3C4B853182350831 (matieres_id), PRIMARY KEY(formations_id, matieres_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matieres (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, programme VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notes (id INT AUTO_INCREMENT NOT NULL, apprenants_id INT NOT NULL, note VARCHAR(255) NOT NULL, INDEX IDX_11BA68CD4B7C9BD (apprenants_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notes_matieres (notes_id INT NOT NULL, matieres_id INT NOT NULL, INDEX IDX_E1913073FC56F556 (notes_id), INDEX IDX_E191307382350831 (matieres_id), PRIMARY KEY(notes_id, matieres_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE suivre (id INT AUTO_INCREMENT NOT NULL, formations_id INT NOT NULL, INDEX IDX_3BC593BB3BF5B0C2 (formations_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tuteurs (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, UNIQUE INDEX UNIQ_58316743A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tutorat (id INT AUTO_INCREMENT NOT NULL, tuteurs_id INT NOT NULL, INDEX IDX_CD4845936FFF0BAB (tuteurs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE apprenants ADD CONSTRAINT FK_C71C2982A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE apprenants ADD CONSTRAINT FK_C71C29821E283B1C FOREIGN KEY (suivre_id) REFERENCES suivre (id)');
        $this->addSql('ALTER TABLE apprenants ADD CONSTRAINT FK_C71C29826C1DB1B6 FOREIGN KEY (tutorat_id) REFERENCES tutorat (id)');
        $this->addSql('ALTER TABLE enseigne_formateurs ADD CONSTRAINT FK_692ADF256C2A0A71 FOREIGN KEY (enseigne_id) REFERENCES enseigne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enseigne_formateurs ADD CONSTRAINT FK_692ADF25FB0881C8 FOREIGN KEY (formateurs_id) REFERENCES formateurs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enseigne_matieres ADD CONSTRAINT FK_EDA665A56C2A0A71 FOREIGN KEY (enseigne_id) REFERENCES enseigne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enseigne_matieres ADD CONSTRAINT FK_EDA665A582350831 FOREIGN KEY (matieres_id) REFERENCES matieres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formateurs ADD CONSTRAINT FK_FD80E574A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE formations_matieres ADD CONSTRAINT FK_3C4B85313BF5B0C2 FOREIGN KEY (formations_id) REFERENCES formations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formations_matieres ADD CONSTRAINT FK_3C4B853182350831 FOREIGN KEY (matieres_id) REFERENCES matieres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE notes ADD CONSTRAINT FK_11BA68CD4B7C9BD FOREIGN KEY (apprenants_id) REFERENCES apprenants (id)');
        $this->addSql('ALTER TABLE notes_matieres ADD CONSTRAINT FK_E1913073FC56F556 FOREIGN KEY (notes_id) REFERENCES notes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE notes_matieres ADD CONSTRAINT FK_E191307382350831 FOREIGN KEY (matieres_id) REFERENCES matieres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE suivre ADD CONSTRAINT FK_3BC593BB3BF5B0C2 FOREIGN KEY (formations_id) REFERENCES formations (id)');
        $this->addSql('ALTER TABLE tuteurs ADD CONSTRAINT FK_58316743A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tutorat ADD CONSTRAINT FK_CD4845936FFF0BAB FOREIGN KEY (tuteurs_id) REFERENCES tuteurs (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apprenants DROP FOREIGN KEY FK_C71C2982A76ED395');
        $this->addSql('ALTER TABLE apprenants DROP FOREIGN KEY FK_C71C29821E283B1C');
        $this->addSql('ALTER TABLE apprenants DROP FOREIGN KEY FK_C71C29826C1DB1B6');
        $this->addSql('ALTER TABLE enseigne_formateurs DROP FOREIGN KEY FK_692ADF256C2A0A71');
        $this->addSql('ALTER TABLE enseigne_formateurs DROP FOREIGN KEY FK_692ADF25FB0881C8');
        $this->addSql('ALTER TABLE enseigne_matieres DROP FOREIGN KEY FK_EDA665A56C2A0A71');
        $this->addSql('ALTER TABLE enseigne_matieres DROP FOREIGN KEY FK_EDA665A582350831');
        $this->addSql('ALTER TABLE formateurs DROP FOREIGN KEY FK_FD80E574A76ED395');
        $this->addSql('ALTER TABLE formations_matieres DROP FOREIGN KEY FK_3C4B85313BF5B0C2');
        $this->addSql('ALTER TABLE formations_matieres DROP FOREIGN KEY FK_3C4B853182350831');
        $this->addSql('ALTER TABLE notes DROP FOREIGN KEY FK_11BA68CD4B7C9BD');
        $this->addSql('ALTER TABLE notes_matieres DROP FOREIGN KEY FK_E1913073FC56F556');
        $this->addSql('ALTER TABLE notes_matieres DROP FOREIGN KEY FK_E191307382350831');
        $this->addSql('ALTER TABLE suivre DROP FOREIGN KEY FK_3BC593BB3BF5B0C2');
        $this->addSql('ALTER TABLE tuteurs DROP FOREIGN KEY FK_58316743A76ED395');
        $this->addSql('ALTER TABLE tutorat DROP FOREIGN KEY FK_CD4845936FFF0BAB');
        $this->addSql('DROP TABLE apprenants');
        $this->addSql('DROP TABLE enseigne');
        $this->addSql('DROP TABLE enseigne_formateurs');
        $this->addSql('DROP TABLE enseigne_matieres');
        $this->addSql('DROP TABLE formateurs');
        $this->addSql('DROP TABLE formations');
        $this->addSql('DROP TABLE formations_matieres');
        $this->addSql('DROP TABLE matieres');
        $this->addSql('DROP TABLE notes');
        $this->addSql('DROP TABLE notes_matieres');
        $this->addSql('DROP TABLE suivre');
        $this->addSql('DROP TABLE tuteurs');
        $this->addSql('DROP TABLE tutorat');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
