<?php

/**
 * sfNavBuilderRendererInterface
 * Provides the interface for any navigation renderer classes
 * @author Chris Sedlmayr catchamonkey <chris@sedlmayr.co.uk>
 * @author Roberto Bermejo Martinez <roberto+sfNavBuilderPlugin@robertobermejo.es>
 */
interface sfNavBuilderRendererInterface
{

    public function render(sfNavBuilder $menu);

    public function renderItem(sfNavBuilderItem $item);
}
