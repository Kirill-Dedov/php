<?php

// Запуск теста ../vendor/bin/phpunit toDoListTest.php

use PHPUnit\Framework\TestCase;

require_once 'toDoList.php';

class ToDoListTest extends TestCase
{
    public function testToDoTaskCreation()
    {
        $task = new ToDoTask('test task', 'test description');

        $this->assertEquals('test task', $task->title);
        $this->assertEquals('test description', $task->description);
        $this->assertFalse($task->completed);
        $this->assertNotEmpty($task->id);
        $this->assertNotEmpty($task->createdAt);
    }

    public function testToDoTaskStatus()
    {
        $task = new ToDoTask('test');
        $this->assertEquals('Uncompleted', $task->getStatus());

        $task->markComplete();
        $this->assertTrue($task->completed);
        $this->assertEquals('Completed', $task->getStatus());

        $task->markIncomplete();
        $this->assertFalse($task->completed);
        $this->assertEquals('Uncompleted', $task->getStatus());
    }

    public function testAddAndGetTasks()
    {
        $task1 = new ToDoTask('test1');
        $task2 = new ToDoTask('test2');
        $toDoList = new ToDoList();

        $toDoList->addTask($task1);
        $toDoList->addTask($task2);
        $tasks = $toDoList->getAllTasks();
        $this->assertCount(2, $tasks);
        $this->assertEquals('test1', $tasks[0]->title);
        $this->assertEquals('test2', $tasks[1]->title);
    }

    public function testRemoveTask()
    {
        $task = new ToDoTask('test');
        $toDoList = new ToDoList();

        $toDoList->addTask($task);
        $this->assertCount(1, $toDoList->getAllTasks());

        $toDoList->removeTask($task->id);
        $this->assertCount(0, $toDoList->getAllTasks());
    }

    public function testRemoveNonexistentTask()
    {
        $toDoList = new ToDoList();

        $this->expectException(InvalidArgumentException::class);
        $toDoList->removeTask('bad id');
    }

    public function testGetCompletedAndGetUncompletedTasks()
    {
        $task1 = new ToDoTask('test1');
        $task2 = new ToDoTask('test2');
        $task3 = new ToDoTask('test3');
        $task4 = new ToDoTask('test4');
        $task1->markComplete();
        $task2->markComplete();

        $toDoList = new ToDoList();
        $toDoList->addTask($task1);
        $toDoList->addTask($task2);
        $toDoList->addTask($task3);
        $toDoList->addTask($task4);

        $completed = $toDoList->getAllCompletedTasks();
        $uncompleted = $toDoList->getAllUncompletedTasks();
        $this->assertCount(2, $completed);
        $this->assertCount(2, $uncompleted);
    }

    public function testMarkTaskComplete()
    {
        $task = new ToDoTask('test');
        $toDoList = new ToDoList();

        $toDoList->addTask($task);
        $toDoList->markTaskCompleted($task->id);
        $testTask = $toDoList->getTask($task->id);
        $this->assertTrue($testTask->completed);
    }

    public function testGetStatistic()
    {
        $todoList = new TodoList();
        $task1 = new TodoTask('test1');
        $task2 = new TodoTask('test2');
        $task3 = new TodoTask('test3');
        $task4 = new TodoTask('test4');

        $todoList->addTask($task1);
        $todoList->addTask($task2);
        $todoList->addTask($task3);
        $todoList->addTask($task4);

        $task1->markComplete();
        $task2->markComplete();

        $statistic = $todoList->getStatistic();

        $this->assertEquals(4, $statistic['total']);
        $this->assertEquals(2, $statistic['completed']);
        $this->assertEquals(2, $statistic['uncompleted']);
        $this->assertEquals(50, $statistic['completionRate']);
    }

    public function testClearCompleted()
    {
        $task1 = new ToDoTask('test1');
        $task2 = new ToDoTask('test2');
        $toDoList = new ToDoList();

        $toDoList->addTask($task1);
        $toDoList->addTask($task2);
        $this->assertCount(2, $toDoList->getAllTasks());
        $toDoList->markTaskCompleted($task1->id);
        $toDoList->clearCompleted();
        $this->assertCount(1, $toDoList->getAllTasks());
        $this->assertEquals('test2', $toDoList->getAllTasks()[0]->title);
    }
}
