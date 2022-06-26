<?php

namespace dsl\context;

/**
 * Class is callable from scripts.
 *
 * Classes whose methods should be callable from user scripts must implement this interface.
 *
 * This is a marker interface which do not has methods by design.
 *
 * If a class do not implement this interface then its methods cannot be called out of a script.
 * This is for security reasons: You cannot expose your classes to the user context by mistake.
 */
interface Scriptable {}