<?php
/*
 * This file is part of the flysystem-stream-wrapper package.
 *
 * (c) 2021-2022 m2m server software gmbh <tech@m2m.at>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace M2MTech\FlysystemStreamWrapper\Tests\FileCommand;

use M2MTech\FlysystemStreamWrapper\Tests\Assert;

class UnlinkTest extends AbstractFileCommandTest
{
    use Assert;

    public function test(): void
    {
        $file = $this->testDir->createFile(true);
        $this->assertFileExists($file->local);
        $this->assertTrue(unlink($file->flysystem));
        $this->assertFileDoesNotExist($file->local);
    }

    public function testFailed(): void
    {
        $file = $this->testDir->createFile();
        $this->assertFalse(@unlink($file->flysystem));

        $dir = $this->testDir->createDirectory(true);
        $this->assertFalse(@unlink($dir->flysystem));

        $this->expectError();
        $this->expectErrorMessage('Could not delete file');
        unlink($dir->flysystem);
    }
}
