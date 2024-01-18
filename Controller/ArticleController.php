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
            $articles[] = new Article($rawArticle['title'], $rawArticle['description'], $rawArticle['publish_date']);
        }
        return $articles;
        } catch (PDOException $e) {
            echo("Select query failed" . $e->getMessage());
        }
    }

    public function show($articleId)
    {
        // this can be used for a detail page
        $article = $this->getArticleById($articleId);
         require 'View/articles/show.php';
    }

}