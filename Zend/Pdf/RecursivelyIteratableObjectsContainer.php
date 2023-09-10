<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Pdf
 * @subpackage Actions
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: RecursivelyIteratableObjectsContainer.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * Iteratable objects container
 *
 * @package    Zend_Pdf
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Pdf_RecursivelyIteratableObjectsContainer implements RecursiveIterator, Countable
{
    protected $_objects = array();

    public function __construct(array $objects) { $this->_objects = $objects; }
    public function current(): mixed
    {
        return current($this->_objects);
    }
    public function key(): string|int|null
    {
        return key($this->_objects);
    }
    public function next(): void
    {
        next($this->_objects);
    }
    public function rewind(): void
    {
        reset($this->_objects);
    }
    public function valid(): bool
    {
        return current($this->_objects) !== false;
    }
    public function getChildren(): ?RecursiveIterator
    {
        return current($this->_objects);
    }
    public function hasChildren(): bool
    {
        return count($this->_objects) > 0;
    }

    public function count(): int
    {
        return count($this->_objects);
    }
}
