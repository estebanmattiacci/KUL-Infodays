<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230727140937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX user_infoday_id_fk ON user');
        $this->addSql('ALTER TABLE user ADD infoday_id INT DEFAULT NULL, DROP infoday');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64989A3684F FOREIGN KEY (infoday_id) REFERENCES infoday (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64989A3684F ON user (infoday_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64989A3684F');
        $this->addSql('DROP INDEX IDX_8D93D64989A3684F ON user');
        $this->addSql('ALTER TABLE user ADD infoday DATE NOT NULL, DROP infoday_id');
        $this->addSql('CREATE INDEX user_infoday_id_fk ON user (infoday)');
    }
}
