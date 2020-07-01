<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200701200024 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hash_tag (id INT AUTO_INCREMENT NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tweet (id INT AUTO_INCREMENT NOT NULL, author VARCHAR(255) NOT NULL, message VARCHAR(1000) NOT NULL, created DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tweet_hash_tag (tweet_id INT NOT NULL, hash_tag_id INT NOT NULL, INDEX IDX_43597BBB1041E39B (tweet_id), INDEX IDX_43597BBBAB18B62D (hash_tag_id), PRIMARY KEY(tweet_id, hash_tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tweet_hash_tag ADD CONSTRAINT FK_43597BBB1041E39B FOREIGN KEY (tweet_id) REFERENCES tweet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tweet_hash_tag ADD CONSTRAINT FK_43597BBBAB18B62D FOREIGN KEY (hash_tag_id) REFERENCES hash_tag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tweet_hash_tag DROP FOREIGN KEY FK_43597BBBAB18B62D');
        $this->addSql('ALTER TABLE tweet_hash_tag DROP FOREIGN KEY FK_43597BBB1041E39B');
        $this->addSql('DROP TABLE hash_tag');
        $this->addSql('DROP TABLE tweet');
        $this->addSql('DROP TABLE tweet_hash_tag');
    }
}
