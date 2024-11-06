<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241106144351 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company ADD created_by_id INT DEFAULT NULL, ADD updated_by_id INT DEFAULT NULL, ADD uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', ADD created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4FBF094FD17F50A6 ON company (uuid)');
        $this->addSql('CREATE INDEX IDX_4FBF094FB03A8386 ON company (created_by_id)');
        $this->addSql('CREATE INDEX IDX_4FBF094F896DBBDE ON company (updated_by_id)');
        $this->addSql('ALTER TABLE contract ADD created_by_id INT DEFAULT NULL, ADD updated_by_id INT DEFAULT NULL, ADD uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', ADD created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE contract ADD CONSTRAINT FK_E98F2859B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE contract ADD CONSTRAINT FK_E98F2859896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E98F2859D17F50A6 ON contract (uuid)');
        $this->addSql('CREATE INDEX IDX_E98F2859B03A8386 ON contract (created_by_id)');
        $this->addSql('CREATE INDEX IDX_E98F2859896DBBDE ON contract (updated_by_id)');
        $this->addSql('ALTER TABLE user ADD created_by_id INT DEFAULT NULL, ADD updated_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649B03A8386 ON user (created_by_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649896DBBDE ON user (updated_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contract DROP FOREIGN KEY FK_E98F2859B03A8386');
        $this->addSql('ALTER TABLE contract DROP FOREIGN KEY FK_E98F2859896DBBDE');
        $this->addSql('DROP INDEX UNIQ_E98F2859D17F50A6 ON contract');
        $this->addSql('DROP INDEX IDX_E98F2859B03A8386 ON contract');
        $this->addSql('DROP INDEX IDX_E98F2859896DBBDE ON contract');
        $this->addSql('ALTER TABLE contract DROP created_by_id, DROP updated_by_id, DROP uuid, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FB03A8386');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F896DBBDE');
        $this->addSql('DROP INDEX UNIQ_4FBF094FD17F50A6 ON company');
        $this->addSql('DROP INDEX IDX_4FBF094FB03A8386 ON company');
        $this->addSql('DROP INDEX IDX_4FBF094F896DBBDE ON company');
        $this->addSql('ALTER TABLE company DROP created_by_id, DROP updated_by_id, DROP uuid, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649B03A8386');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649896DBBDE');
        $this->addSql('DROP INDEX IDX_8D93D649B03A8386 ON user');
        $this->addSql('DROP INDEX IDX_8D93D649896DBBDE ON user');
        $this->addSql('ALTER TABLE user DROP created_by_id, DROP updated_by_id');
    }
}
