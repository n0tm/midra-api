<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210411181538 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, university_group_id INT NOT NULL, teacher_id INT NOT NULL, subject_id INT NOT NULL, name VARCHAR(255) NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_3BAE0AA74649FBED (university_group_id), INDEX IDX_3BAE0AA741807E1D (teacher_id), INDEX IDX_3BAE0AA723EDC87 (subject_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subject (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teacher (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE university_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA74649FBED FOREIGN KEY (university_group_id) REFERENCES university_group (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA741807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA723EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA723EDC87');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA741807E1D');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA74649FBED');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE subject');
        $this->addSql('DROP TABLE teacher');
        $this->addSql('DROP TABLE university_group');
    }
}
