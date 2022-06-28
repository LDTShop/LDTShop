<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220628103307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, username_id INT NOT NULL, product_id INT NOT NULL, pro_quantity INT NOT NULL, date DATE NOT NULL, INDEX IDX_BA388B7ED766068 (username_id), INDEX IDX_BA388B74584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, cus_name VARCHAR(255) NOT NULL, gender INT NOT NULL, address VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, date DATE NOT NULL, state TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_81398E09F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, username_id INT NOT NULL, order_date DATE NOT NULL, delivery_date DATE NOT NULL, address LONGTEXT NOT NULL, payment INT NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_E52FFDEEED766068 (username_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders_detail (id INT AUTO_INCREMENT NOT NULL, order_id_id INT NOT NULL, product_id_id INT NOT NULL, pro_quantity INT NOT NULL, price NUMERIC(10, 0) NOT NULL, total NUMERIC(10, 0) NOT NULL, INDEX IDX_8F964642FCDAEAAA (order_id_id), INDEX IDX_8F964642DE18E50B (product_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7ED766068 FOREIGN KEY (username_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B74584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEED766068 FOREIGN KEY (username_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE orders_detail ADD CONSTRAINT FK_8F964642FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE orders_detail ADD CONSTRAINT FK_8F964642DE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product ADD brand_id INT NOT NULL, ADD status TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD44F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD44F5D008 ON product (brand_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7ED766068');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEED766068');
        $this->addSql('ALTER TABLE orders_detail DROP FOREIGN KEY FK_8F964642FCDAEAAA');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE orders_detail');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD44F5D008');
        $this->addSql('DROP INDEX IDX_D34A04AD44F5D008 ON product');
        $this->addSql('ALTER TABLE product DROP brand_id, DROP status');
    }
}
