<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230320133852 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apprenants ADD password VARCHAR(255) NOT NULL, CHANGE id_apprenants email VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE enseigne CHANGE id_formateurs id_formateurs INT NOT NULL, CHANGE id_matieres id_matieres INT NOT NULL');
        $this->addSql('ALTER TABLE formateurs DROP id_formateurs');
        $this->addSql('ALTER TABLE formations DROP id_formations, CHANGE id_matieres id_matieres INT NOT NULL');
        $this->addSql('ALTER TABLE matieres DROP id_matieres');
        $this->addSql('ALTER TABLE note CHANGE note note INT NOT NULL, CHANGE id_apprenants id_apprenants INT NOT NULL, CHANGE id_matieres id_matieres INT NOT NULL');
        $this->addSql('ALTER TABLE suivre ADD id_formateurs INT NOT NULL, DROP id_formations, CHANGE id_apprenants id_apprenants INT NOT NULL');
        $this->addSql('ALTER TABLE tuteurs DROP id_tuteurs, CHANGE id_apprenants id_apprenants INT NOT NULL');
        $this->addSql('ALTER TABLE tutorat ADD id_tuteur INT NOT NULL, DROP id_tuteurs, CHANGE id_apprenants id_apprenants INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apprenants ADD id_apprenants VARCHAR(255) NOT NULL, DROP email, DROP password');
        $this->addSql('ALTER TABLE enseigne CHANGE id_formateurs id_formateurs VARCHAR(255) NOT NULL, CHANGE id_matieres id_matieres VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE formateurs ADD id_formateurs VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE formations ADD id_formations VARCHAR(255) NOT NULL, CHANGE id_matieres id_matieres VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE matieres ADD id_matieres VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE note CHANGE note note VARCHAR(255) NOT NULL, CHANGE id_apprenants id_apprenants VARCHAR(255) NOT NULL, CHANGE id_matieres id_matieres VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE suivre ADD id_formations VARCHAR(255) NOT NULL, DROP id_formateurs, CHANGE id_apprenants id_apprenants VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE tuteurs ADD id_tuteurs VARCHAR(255) NOT NULL, CHANGE id_apprenants id_apprenants VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE tutorat ADD id_tuteurs VARCHAR(255) NOT NULL, DROP id_tuteur, CHANGE id_apprenants id_apprenants VARCHAR(255) NOT NULL');
    }
}
