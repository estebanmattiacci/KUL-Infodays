<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230729090942 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE feedback ADD datevisited_id INT NOT NULL, DROP datevisited');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D22944584A236C26 FOREIGN KEY (datevisited_id) REFERENCES infoday (id)');
        $this->addSql('CREATE INDEX IDX_D22944584A236C26 ON feedback (datevisited_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D22944584A236C26');
        $this->addSql('DROP INDEX IDX_D22944584A236C26 ON feedback');
        $this->addSql('ALTER TABLE feedback ADD datevisited DATE NOT NULL, DROP datevisited_id');
    }
}
