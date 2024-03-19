<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230803185936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE interests (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE interests_feedback (interests_id INT NOT NULL, feedback_id INT NOT NULL, INDEX IDX_3290F343734F135E (interests_id), INDEX IDX_3290F343D249A887 (feedback_id), PRIMARY KEY(interests_id, feedback_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE interests_feedback ADD CONSTRAINT FK_3290F343734F135E FOREIGN KEY (interests_id) REFERENCES interests (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE interests_feedback ADD CONSTRAINT FK_3290F343D249A887 FOREIGN KEY (feedback_id) REFERENCES feedback (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE feedback DROP interest');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE interests_feedback DROP FOREIGN KEY FK_3290F343734F135E');
        $this->addSql('ALTER TABLE interests_feedback DROP FOREIGN KEY FK_3290F343D249A887');
        $this->addSql('DROP TABLE interests');
        $this->addSql('DROP TABLE interests_feedback');
        $this->addSql('ALTER TABLE feedback ADD interest VARCHAR(180) DEFAULT NULL');
    }
}
