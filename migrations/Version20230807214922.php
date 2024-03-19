<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230807214922 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE feedback DROP user_id');
        $this->addSql('ALTER TABLE interest_feedback DROP FOREIGN KEY FK_3290F343734F135E');
        $this->addSql('DROP INDEX IDX_3290F343734F135E ON interest_feedback');
        $this->addSql('DROP INDEX `primary` ON interest_feedback');
        $this->addSql('ALTER TABLE interest_feedback CHANGE interests_id interest_id INT NOT NULL');
        $this->addSql('ALTER TABLE interest_feedback ADD CONSTRAINT FK_AEFAD1985A95FF89 FOREIGN KEY (interest_id) REFERENCES interest (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_AEFAD1985A95FF89 ON interest_feedback (interest_id)');
        $this->addSql('ALTER TABLE interest_feedback ADD PRIMARY KEY (interest_id, feedback_id)');
        $this->addSql('ALTER TABLE interest_feedback RENAME INDEX idx_3290f343d249a887 TO IDX_AEFAD198D249A887');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D249A887');
        $this->addSql('DROP INDEX UNIQ_8D93D649D249A887 ON user');
        $this->addSql('ALTER TABLE user DROP feedback_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE feedback ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD feedback_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D249A887 FOREIGN KEY (feedback_id) REFERENCES feedback (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649D249A887 ON user (feedback_id)');
        $this->addSql('ALTER TABLE interest_feedback DROP FOREIGN KEY FK_AEFAD1985A95FF89');
        $this->addSql('DROP INDEX IDX_AEFAD1985A95FF89 ON interest_feedback');
        $this->addSql('DROP INDEX `PRIMARY` ON interest_feedback');
        $this->addSql('ALTER TABLE interest_feedback CHANGE interest_id interests_id INT NOT NULL');
        $this->addSql('ALTER TABLE interest_feedback ADD CONSTRAINT FK_3290F343734F135E FOREIGN KEY (interests_id) REFERENCES interest (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_3290F343734F135E ON interest_feedback (interests_id)');
        $this->addSql('ALTER TABLE interest_feedback ADD PRIMARY KEY (interests_id, feedback_id)');
        $this->addSql('ALTER TABLE interest_feedback RENAME INDEX idx_aefad198d249a887 TO IDX_3290F343D249A887');
    }
}
