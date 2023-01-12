<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230111195106 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customer_enterprise (customer_id INT NOT NULL, enterprise_id INT NOT NULL, INDEX IDX_4C7A6E819395C3F3 (customer_id), INDEX IDX_4C7A6E81A97D1AC3 (enterprise_id), PRIMARY KEY(customer_id, enterprise_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE customer_enterprise ADD CONSTRAINT FK_4C7A6E819395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE customer_enterprise ADD CONSTRAINT FK_4C7A6E81A97D1AC3 FOREIGN KEY (enterprise_id) REFERENCES enterprise (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE customer_enterprise');
    }
}
