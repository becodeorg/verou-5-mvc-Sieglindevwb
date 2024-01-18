<?php

declare(strict_types = 1);

class ArticleController
{

    private DatabaseManager $dbManager;

    public function __construct(DatabaseManager $dbManager)
    {
        $this->dbManager = $dbManager;
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
        echo "Before connecting to the database<br>";
        //prepare the database connection
        $this->dbManager->connect();

        echo "After connecting to the database<br>";
        // Note: you might want to use a re-usable databaseManager class - the choice is yours
        // fetch all articles as $rawArticles (as a simple array)
        $statement = $this->dbManager->connection->query('SELECT * FROM articles');
        $rawArticles = $statement->fetchAll();
        $rawArticles = [];

        foreach ($rawArticles as $rawArticle) {
            // We are converting an article from a "dumb" array to a much more flexible class
            $articles[] = new Article($rawArticle['title'], $rawArticle['description'], $rawArticle['publish_date']);
        }

        return $articles;
    }

    public function show($articleId)
    {
        // this can be used for a detail page
        $article = $this->getArticleById($articleId);
         require 'View/articles/show.php';
    }

    private function getArticleById($articleId)
{
    // fetch the article details based on $articleId
    $statement = $this->dbManager->connection->prepare('SELECT * FROM articles WHERE id = :id');
    $statement->bindParam(':id', $articleId);
    $statement->execute();

    $rawArticle = $statement->fetchAll();

    // Convert the raw data into an Article object
    return new Article($rawArticle['title'], $rawArticle['description'], $rawArticle['publish_date']);
}
}