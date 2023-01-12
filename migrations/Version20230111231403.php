<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230111231403 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B74A4A3511');
        $this->addSql('ALTER TABLE comment_vehicule DROP FOREIGN KEY FK_346B9C1B4A4A3511');
        $this->addSql('ALTER TABLE favorite_vehicules DROP FOREIGN KEY FK_B23119BF4A4A3511');
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FB4A4A3511');
        $this->addSql('CREATE TABLE comment_vehicle (id INT AUTO_INCREMENT NOT NULL, vehicle_id INT DEFAULT NULL, customer_id INT DEFAULT NULL, content LONGTEXT DEFAULT NULL, rating INT DEFAULT NULL, INDEX IDX_E8F38696545317D1 (vehicle_id), INDEX IDX_E8F386969395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favorite_vehicles (customer_id INT NOT NULL, vehicle_id INT NOT NULL, INDEX IDX_B599710B9395C3F3 (customer_id), INDEX IDX_B599710B545317D1 (vehicle_id), PRIMARY KEY(customer_id, vehicle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle (id INT AUTO_INCREMENT NOT NULL, enterprise_id INT DEFAULT NULL, model VARCHAR(255) DEFAULT NULL, brand VARCHAR(255) DEFAULT NULL, energy VARCHAR(255) DEFAULT NULL, power INT DEFAULT NULL, passenger INT DEFAULT NULL, load_capacity INT DEFAULT NULL, description LONGTEXT DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, price INT DEFAULT NULL, milage INT DEFAULT NULL, location VARCHAR(255) DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, numberplate VARCHAR(255) DEFAULT NULL, color VARCHAR(255) DEFAULT NULL, INDEX IDX_1B80E486A97D1AC3 (enterprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment_vehicle ADD CONSTRAINT FK_E8F38696545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('ALTER TABLE comment_vehicle ADD CONSTRAINT FK_E8F386969395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE favorite_vehicles ADD CONSTRAINT FK_B599710B9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorite_vehicles ADD CONSTRAINT FK_B599710B545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E486A97D1AC3 FOREIGN KEY (enterprise_id) REFERENCES enterprise (id)');
        $this->addSql('DROP TABLE comment_vehicule');
        $this->addSql('DROP TABLE favorite_vehicules');
        $this->addSql('DROP TABLE vehicule');
        $this->addSql('DROP INDEX IDX_BA388B74A4A3511 ON cart');
        $this->addSql('ALTER TABLE cart CHANGE vehicule_id vehicle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('CREATE INDEX IDX_BA388B7545317D1 ON cart (vehicle_id)');
        $this->addSql('DROP INDEX IDX_5A3811FB4A4A3511 ON schedule');
        $this->addSql('ALTER TABLE schedule CHANGE vehicule_id vehicle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('CREATE INDEX IDX_5A3811FB545317D1 ON schedule (vehicle_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7545317D1');
        $this->addSql('ALTER TABLE comment_vehicle DROP FOREIGN KEY FK_E8F38696545317D1');
        $this->addSql('ALTER TABLE favorite_vehicles DROP FOREIGN KEY FK_B599710B545317D1');
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FB545317D1');
        $this->addSql('CREATE TABLE comment_vehicule (id INT AUTO_INCREMENT NOT NULL, vehicule_id INT DEFAULT NULL, customer_id INT DEFAULT NULL, content LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, rating INT DEFAULT NULL, INDEX IDX_346B9C1B4A4A3511 (vehicule_id), INDEX IDX_346B9C1B9395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE favorite_vehicules (customer_id INT NOT NULL, vehicule_id INT NOT NULL, INDEX IDX_B23119BF4A4A3511 (vehicule_id), INDEX IDX_B23119BF9395C3F3 (customer_id), PRIMARY KEY(customer_id, vehicule_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE vehicule (id INT AUTO_INCREMENT NOT NULL, enterprise_id INT DEFAULT NULL, model VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, brand VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, energy VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, power INT DEFAULT NULL, passenger INT DEFAULT NULL, load_capacity INT DEFAULT NULL, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, photo VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, price INT DEFAULT NULL, milage INT DEFAULT NULL, location VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, status VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, numberplate VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, color VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_292FFF1DA97D1AC3 (enterprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE comment_vehicule ADD CONSTRAINT FK_346B9C1B4A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE comment_vehicule ADD CONSTRAINT FK_346B9C1B9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE favorite_vehicules ADD CONSTRAINT FK_B23119BF4A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorite_vehicules ADD CONSTRAINT FK_B23119BF9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1DA97D1AC3 FOREIGN KEY (enterprise_id) REFERENCES enterprise (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE comment_vehicle');
        $this->addSql('DROP TABLE favorite_vehicles');
        $this->addSql('DROP TABLE vehicle');
        $this->addSql('DROP INDEX IDX_BA388B7545317D1 ON cart');
        $this->addSql('ALTER TABLE cart CHANGE vehicle_id vehicule_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B74A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_BA388B74A4A3511 ON cart (vehicule_id)');
        $this->addSql('DROP INDEX IDX_5A3811FB545317D1 ON schedule');
        $this->addSql('ALTER TABLE schedule CHANGE vehicle_id vehicule_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB4A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_5A3811FB4A4A3511 ON schedule (vehicule_id)');
    }
}
