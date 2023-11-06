<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231106091523 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appartement (id INT AUTO_INCREMENT NOT NULL, immeuble_id INT NOT NULL, appartenir_categorie_id INT NOT NULL, superficie DOUBLE PRECISION NOT NULL, descriptif LONGTEXT NOT NULL, INDEX IDX_71A6BD8D63768E3F (immeuble_id), INDEX IDX_71A6BD8DE1D153A6 (appartenir_categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, libelle_categorie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE immeuble (id INT AUTO_INCREMENT NOT NULL, nom_immeuble VARCHAR(255) NOT NULL, rue_immeuble VARCHAR(255) NOT NULL, cp_immeuble INT NOT NULL, ville_immeuble VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, num_appart_id INT NOT NULL, date_reserv DATETIME NOT NULL, nom_client VARCHAR(255) NOT NULL, prenom_client VARCHAR(255) NOT NULL, rue_client VARCHAR(255) NOT NULL, cp_client INT NOT NULL, ville_client VARCHAR(255) NOT NULL, tel_client INT NOT NULL, num_cheque_acompte INT NOT NULL, montant_acompte DOUBLE PRECISION NOT NULL, etat_reservation VARCHAR(255) NOT NULL, INDEX IDX_42C84955A210F097 (num_appart_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation_semaine (reservation_id INT NOT NULL, semaine_id INT NOT NULL, INDEX IDX_1CD8306FB83297E7 (reservation_id), INDEX IDX_1CD8306F122EEC90 (semaine_id), PRIMARY KEY(reservation_id, semaine_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE saison (id INT AUTO_INCREMENT NOT NULL, libelle_saison VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE semaine (id INT AUTO_INCREMENT NOT NULL, num_saison_id INT NOT NULL, annee INT NOT NULL, date_debut DATETIME NOT NULL, INDEX IDX_7B4D8BEA8BBB3590 (num_saison_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tarif (id INT AUTO_INCREMENT NOT NULL, categorie_id_id INT NOT NULL, saison_id_id INT NOT NULL, prix_semaine DOUBLE PRECISION NOT NULL, INDEX IDX_E7189C98A3C7387 (categorie_id_id), INDEX IDX_E7189C9CB7B5AFE (saison_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appartement ADD CONSTRAINT FK_71A6BD8D63768E3F FOREIGN KEY (immeuble_id) REFERENCES immeuble (id)');
        $this->addSql('ALTER TABLE appartement ADD CONSTRAINT FK_71A6BD8DE1D153A6 FOREIGN KEY (appartenir_categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A210F097 FOREIGN KEY (num_appart_id) REFERENCES appartement (id)');
        $this->addSql('ALTER TABLE reservation_semaine ADD CONSTRAINT FK_1CD8306FB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_semaine ADD CONSTRAINT FK_1CD8306F122EEC90 FOREIGN KEY (semaine_id) REFERENCES semaine (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE semaine ADD CONSTRAINT FK_7B4D8BEA8BBB3590 FOREIGN KEY (num_saison_id) REFERENCES saison (id)');
        $this->addSql('ALTER TABLE tarif ADD CONSTRAINT FK_E7189C98A3C7387 FOREIGN KEY (categorie_id_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE tarif ADD CONSTRAINT FK_E7189C9CB7B5AFE FOREIGN KEY (saison_id_id) REFERENCES saison (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appartement DROP FOREIGN KEY FK_71A6BD8D63768E3F');
        $this->addSql('ALTER TABLE appartement DROP FOREIGN KEY FK_71A6BD8DE1D153A6');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A210F097');
        $this->addSql('ALTER TABLE reservation_semaine DROP FOREIGN KEY FK_1CD8306FB83297E7');
        $this->addSql('ALTER TABLE reservation_semaine DROP FOREIGN KEY FK_1CD8306F122EEC90');
        $this->addSql('ALTER TABLE semaine DROP FOREIGN KEY FK_7B4D8BEA8BBB3590');
        $this->addSql('ALTER TABLE tarif DROP FOREIGN KEY FK_E7189C98A3C7387');
        $this->addSql('ALTER TABLE tarif DROP FOREIGN KEY FK_E7189C9CB7B5AFE');
        $this->addSql('DROP TABLE appartement');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE immeuble');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE reservation_semaine');
        $this->addSql('DROP TABLE saison');
        $this->addSql('DROP TABLE semaine');
        $this->addSql('DROP TABLE tarif');
    }
}
