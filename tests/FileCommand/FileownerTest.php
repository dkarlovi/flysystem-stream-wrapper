<?php
/*
 * This file is part of the flysystem-stream-wrapper package.
 *
 * (c) 2021-2022 m2m server software gmbh <tech@m2m.at>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace M2MTech\FlysystemStreamWrapper\Tests\FileCommand;

class FileownerTest extends AbstractFileCommandTest
{
    public function test(): void
    {
        $file = $this->testDir->createFile(true);
        $this->assertSame(0, fileowner($file->flysystem));
    }

    public function testFailed(): void
    {
        $file = $this->testDir->createFile();
        $this->assertFalse(@fileowner($file->flysystem));

        $this->expectError();
        $this->expectErrorMessage('Stat failed');
        /** @noinspection PhpUnusedLocalVariableInspection */
        $owner = fileowner($file->flysystem);
    }
}
