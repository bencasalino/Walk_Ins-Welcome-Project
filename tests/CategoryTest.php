<?php
    /**
    *@backupGlobals disabled
    *@backupStaticAttributes disabled
    */

    require_once "src/user.php";
    require_once "src/category.php";

    $server = 'mysql:host=localhost;dbname=walk_in_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    class CategoryTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            User::deleteAll();
            Category::deleteAll();
        }

        function testSetCategoryName()
        {
            $category_name = "music";
            $new_category = new Category($category_name);

            $new_category->setCategoryName("concerts");
            $result = $new_category->getCategoryName();

            $this->assertEquals("concerts", $result);
        }

        function testGetCategoryName()
        {
            $category_name = "music";
            $new_category = new Category($category_name);

            $result = $new_category->getCategoryName();

            $this->assertEquals("music", $result);
        }

        function testGetId()
        {
            $category_name = "music";
            $id = 1;
            $new_category = new Category($category_name, $id);

            $result = $new_category->getId();

            $this->assertEquals(1, $result);
        }

        function testGetAll()
        {
            $category_name = "music";
            $new_category = new Category($category_name);
            $new_category->save();

            $category_name2 = "arts";
            $new_category2 = new Category($category_name);
            $new_category2->save();

            $result = Category::getAll();

            $this->assertEquals([$new_category, $new_category2], $result);
        }

        function testSave()
        {
            $category_name = "music";
            $new_category = new Category($category_name);

            $new_category->save();
            $result = Category::getAll();

            $this->assertEquals($new_category, $result[0]);
        }

        function testDeleteAll()
        {
            $category_name = "music";
            $new_category = new Category($category_name);
            $new_category->save();

            $category_name2 = "arts";
            $new_category2 = new Category($category_name);
            $new_category2->save();

            Category::deleteAll();
            $result = Category::GetAll();

            $this->assertEquals([], $result);
        }

        function testDeleteOne()
        {
            $category_name = "music";
            $new_category = new Category($category_name);
            $new_category->save();

            $category_name2 = "arts";
            $new_category2 = new Category($category_name);
            $new_category2->save();

            $new_category->deleteOne();

            $result = Category::getAll();

            $this->assertEquals($new_category2, $result[0]);

        }

        function testUpdate()
        {
            $category_name = "music";
            $new_category = new Category($category_name);
            $new_category->save();
            $new_category->setCategoryName("concerts");
            $new_category->update();

            $result = Category::getAll();

            $this->assertEquals($new_category, $result[0]);
        }

        function testFind()
        {
            $category_name = "music";
            $new_category = new Category($category_name);
            $new_category->save();

            $category_name2 = "arts";
            $new_category2 = new Category($category_name);
            $new_category2->save();

            $result = Category::find($new_category->getId());

            $this->assertEquals($new_category, $result);

        }

    }
?>
