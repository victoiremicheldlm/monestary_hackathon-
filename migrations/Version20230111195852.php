<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230111195852 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart ADD customer_id INT DEFAULT NULL, ADD vehicule_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B79395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B74A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('CREATE INDEX IDX_BA388B79395C3F3 ON cart (customer_id)');
        $this->addSql('CREATE INDEX IDX_BA388B74A4A3511 ON cart (vehicule_id)');
        $this->addSql('ALTER TABLE comment_enterprise ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment_enterprise ADD CONSTRAINT FK_3352E0239395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('CREATE INDEX IDX_3352E0239395C3F3 ON comment_enterprise (customer_id)');
        $this->addSql('ALTER TABLE comment_vehicule ADD vehicule_id INT DEFAULT NULL, ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment_vehicule ADD CONSTRAINT FK_346B9C1B4A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE comment_vehicule ADD CONSTRAINT FK_346B9C1B9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('CREATE INDEX IDX_346B9C1B4A4A3511 ON comment_vehicule (vehicule_id)');
        $this->addSql('CREATE INDEX IDX_346B9C1B9395C3F3 ON comment_vehicule (customer_id)');
        $this->addSql('ALTER TABLE customer ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81398E09A76ED395 ON customer (user_id)');
        $this->addSql('ALTER TABLE driver ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE driver ADD CONSTRAINT FK_11667CD9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_11667CD9A76ED395 ON driver (user_id)');
        $this->addSql('ALTER TABLE enterprise ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE enterprise ADD CONSTRAINT FK_B1B36A03A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B1B36A03A76ED395 ON enterprise (user_id)');
        $this->addSql('ALTER TABLE `order` ADD customer_id INT DEFAULT NULL, ADD schedule_id INT DEFAULT NULL, ADD driver_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993989395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A40BC2D5 FOREIGN KEY (schedule_id) REFERENCES schedule (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398C3423909 FOREIGN KEY (driver_id) REFERENCES driver (id)');
        $this->addSql('CREATE INDEX IDX_F52993989395C3F3 ON `order` (customer_id)');
        $this->addSql('CREATE INDEX IDX_F5299398A40BC2D5 ON `order` (schedule_id)');
        $this->addSql('CREATE INDEX IDX_F5299398C3423909 ON `order` (driver_id)');
        $this->addSql('ALTER TABLE schedule ADD vehicule_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB4A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('CREATE INDEX IDX_5A3811FB4A4A3511 ON schedule (vehicule_id)');
        $this->addSql('ALTER TABLE ticket ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3A76ED395 ON ticket (user_id)');
        $this->addSql('ALTER TABLE vehicule ADD enterprise_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1DA97D1AC3 FOREIGN KEY (enterprise_id) REFERENCES enterprise (id)');
        $this->addSql('CREATE INDEX IDX_292FFF1DA97D1AC3 ON vehicule (enterprise_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B79395C3F3');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B74A4A3511');
        $this->addSql('DROP INDEX IDX_BA388B79395C3F3 ON cart');
        $this->addSql('DROP INDEX IDX_BA388B74A4A3511 ON cart');
        $this->addSql('ALTER TABLE cart DROP customer_id, DROP vehicule_id');
        $this->addSql('ALTER TABLE comment_enterprise DROP FOREIGN KEY FK_3352E0239395C3F3');
        $this->addSql('DROP INDEX IDX_3352E0239395C3F3 ON comment_enterprise');
        $this->addSql('ALTER TABLE comment_enterprise DROP customer_id');
        $this->addSql('ALTER TABLE comment_vehicule DROP FOREIGN KEY FK_346B9C1B4A4A3511');
        $this->addSql('ALTER TABLE comment_vehicule DROP FOREIGN KEY FK_346B9C1B9395C3F3');
        $this->addSql('DROP INDEX IDX_346B9C1B4A4A3511 ON comment_vehicule');
        $this->addSql('DROP INDEX IDX_346B9C1B9395C3F3 ON comment_vehicule');
        $this->addSql('ALTER TABLE comment_vehicule DROP vehicule_id, DROP customer_id');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09A76ED395');
        $this->addSql('DROP INDEX UNIQ_81398E09A76ED395 ON customer');
        $this->addSql('ALTER TABLE customer DROP user_id');
        $this->addSql('ALTER TABLE driver DROP FOREIGN KEY FK_11667CD9A76ED395');
        $this->addSql('DROP INDEX UNIQ_11667CD9A76ED395 ON driver');
        $this->addSql('ALTER TABLE driver DROP user_id');
        $this->addSql('ALTER TABLE enterprise DROP FOREIGN KEY FK_B1B36A03A76ED395');
        $this->addSql('DROP INDEX UNIQ_B1B36A03A76ED395 ON enterprise');
        $this->addSql('ALTER TABLE enterprise DROP user_id');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993989395C3F3');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A40BC2D5');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398C3423909');
        $this->addSql('DROP INDEX IDX_F52993989395C3F3 ON `order`');
        $this->addSql('DROP INDEX IDX_F5299398A40BC2D5 ON `order`');
        $this->addSql('DROP INDEX IDX_F5299398C3423909 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP customer_id, DROP schedule_id, DROP driver_id');
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FB4A4A3511');
        $this->addSql('DROP INDEX IDX_5A3811FB4A4A3511 ON schedule');
        $this->addSql('ALTER TABLE schedule DROP vehicule_id');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3A76ED395');
        $this->addSql('DROP INDEX IDX_97A0ADA3A76ED395 ON ticket');
        $this->addSql('ALTER TABLE ticket DROP user_id');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1DA97D1AC3');
        $this->addSql('DROP INDEX IDX_292FFF1DA97D1AC3 ON vehicule');
        $this->addSql('ALTER TABLE vehicule DROP enterprise_id');
    }
}
