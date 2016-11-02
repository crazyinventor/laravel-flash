<?php

namespace CrazyInventor\LaFlash;

use Log;

class Flash
{
	private $session_key = 'LaFlash';

	/**
	 * Valid message levels
	 *
	 * @var array
	 */
	private $valid_levels = [
		'info',
		'warning',
		'success',
		'error',
	];

	/**
	 * The actual messages
	 *
	 * @var array
	 */
	private $messages = [];

	/**
	 * Flash constructor.
	 */
	public function __construct()
	{
		// prepare flash levels
		if($levels = config('flash.valid_levels'))
		{
			$this->valid_levels = $levels;
		}
		// load existing messages
		$this->messages = $this->getMessages();
	}

	/**
	 * Magic method to log messages on customized levels
	 *
	 * @param $name
	 * @param $arguments
	 */
	public function __call($name, $arguments)
	{
		if(in_array($name, $this->valid_levels)) {
			// store everything
			$this->messages[$name][] = $arguments[0];
			session([$this->session_key => $this->messages]);
			Log::debug("Storing flash message '" . $arguments[0] . "'.");
		} else {
			throw new \InvalidArgumentException("Storing flash message failed, invalid level '$name'.");
		}
	}

	/**
	 * Check if there are messages
	 *
	 * @param string $level
	 * @return bool
	 */
	public function hasMessages($level = false)
	{
		$key = $this->session_key;
		if($level)
		{
			$key = '.' . $level;
		}
		return (count(session($key, []))>0);
	}

	/**
	 * Get all messages or only for given levels
	 *
	 * @param bool $level
	 * @return mixed
	 */
	public function getMessages($level = false)
	{
		$key = $this->session_key;
		if($level)
		{
			$key = '.' . $level;
		}
		return session($key, []);
	}

	/**
	 * Get the existing levels
	 *
	 * @return array
	 */
	public function getLevels()
	{
		return $this->valid_levels;
	}

	/**
	 * Delete session values and return stored messages
	 *
	 * @return array|mixed
	 */
	public function flush()
	{
		session()->forget($this->session_key);
		return $this->messages;
	}
}
