<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230111195835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE favorite_enterprises (customer_id INT NOT NULL, enterprise_id INT NOT NULL, INDEX IDX_41A468989395C3F3 (customer_id), INDEX IDX_41A46898A97D1AC3 (enterprise_id), PRIMARY KEY(customer_id, enterprise_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favorite_vehicules (customer_id INT NOT NULL, vehicule_id INT NOT NULL, INDEX IDX_B23119BF9395C3F3 (customer_id), INDEX IDX_B23119BF4A4A3511 (vehicule_id), PRIMARY KEY(customer_id, vehicule_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE favorite_enterprises ADD CONSTRAINT FK_41A468989395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorite_enterprises ADD CONSTRAINT FK_41A46898A97D1AC3 FOREIGN KEY (enterprise_id) REFERENCES enterprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorite_vehicules ADD CONSTRAINT FK_B23119BF9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorite_vehicules ADD CONSTRAINT FK_B23119BF4A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE favorite_enterprises');
        $this->addSql('DROP TABLE favorite_vehicules');
    }
}
