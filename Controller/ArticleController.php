<?php

declare(strict_types = 1);

class ArticleController
{

    private DatabaseManager $databaseManager;

    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    public function index()
    {
        // Load all required data
        $articles = $this->getArticles();

        // Load the view
        require 'View/articles/index.php';
    }

    // Note: this function can also be used in a repository - the choice is yours
    private function getArticles()
    {
        //prepare the database connection
        $this->databaseManager->connect();

        // Note: you might want to use a re-usable databaseManager class - the choice is yours
        // fetch all articles as $rawArticles (as a simple array)
        try {
        $statement = $this->databaseManager->connection->query('SELECT * FROM articles');
        $rawArticles = $statement->fetchAll();

        $articles = [];
        foreach ($rawArticles as $rawArticle) {
            // We are converting an article from a "dumb" array to a much more flexible class
            $articles[] = new Article($rawArticle['id'], $rawArticle['title'], $rawArticle['description'], $rawArticle['publish_date'], $rawArticle['image_url']);
        }
        return $articles;
        } catch (PDOException $e) {
            echo("Select query failed" . $e->getMessage());
            die();
        }
    }

    public function show($articleId)
    {
        // this can be used for a detail page
        $article = $this->getArticleById($articleId);

        if ($article === null) {
            echo "Article not found";
            return;
        }

        $prevArticleId = $this->getPrevArticleId($articleId);
        $nextArticleId = $this->getNextArticleId($articleId);

         require 'View/articles/show.php';
    }

    private function getArticleById($articleId)
    {
        if ($articleId === null || !is_numeric($articleId)) {
        // Handle the case when $articleId is NULL or not a valid number
        // You might want to redirect to an error page or show an error message.
        echo "Invalid article ID";
        return null;
    }
        $this->databaseManager->connect();

        $statement = $this->databaseManager->connection->prepare('SELECT * FROM articles WHERE id = :id');
        $statement->bindParam(':id', $articleId);
        $statement->execute();

        $rawArticle = $statement->fetch(PDO::FETCH_ASSOC);

        return $rawArticle ? new Article($rawArticle['id'], $rawArticle['title'], $rawArticle['description'], $rawArticle['publish_date'], $rawArticle['image_url']) : null;
    }

    private function getPrevArticleId($currentArticleId)
    {
        $statement = $this->databaseManager->connection->prepare('SELECT id FROM articles WHERE id < :currentId ORDER BY id DESC LIMIT 1');
        $statement->bindParam(':currentId', $currentArticleId);
        $statement->execute();

        $prevArticleId = $statement->fetch(PDO::FETCH_COLUMN);

        if ($prevArticleId === false) {
            // If there is no previous article, get the ID of the last article
            $statement = $this->databaseManager->connection->query('SELECT id FROM articles ORDER BY id DESC LIMIT 1');
            $lastArticleId = $statement->fetch(PDO::FETCH_COLUMN);

            return $lastArticleId;
        }

        return $prevArticleId;
    }

    private function getNextArticleId($currentArticleId)
    {
        $statement = $this->databaseManager->connection->prepare('SELECT id FROM articles WHERE id > :currentId ORDER BY id ASC LIMIT 1');
        $statement->bindParam(':currentId', $currentArticleId);
        $statement->execute();

        $nextArticleId = $statement->fetch(PDO::FETCH_COLUMN);

        if ($nextArticleId === false) {
            $statement = $this->databaseManager->connection->query('SELECT id FROM articles ORDER BY id ASC LIMIT 1');
            $firstArticleId = $statement->fetch(PDO::FETCH_COLUMN);

            return $firstArticleId;
        }

        return $nextArticleId;
    }

}