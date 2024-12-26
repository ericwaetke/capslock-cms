<?php

Kirby::plugin('seriamlo/mh-image-block', [
  // we dont need any blueprints, as this plugin just adds a hook to change image blocks
  'hooks' => [
    'page.update:after' => function ($newPage, $oldPage) {
        $newBlocks = new Kirby\Cms\Blocks();
        $blocks    = $newPage->blocks()->toBlocks();

        foreach ($blocks as $block) :
        if ($block->type() !== 'image') {
            $newBlocks->add($block);
        } else {
            $url      = $block->image()->toFile()->url();
            $images   = $block->image()->toFiles()->pluck('filename');
            $newBlock = new \Kirby\Cms\Block(
                [
              "content" => [
                'location' => 'kirby',
                'image'    => $images,
                'alt'      => $block->alt()->value(),
                'caption'  => $block->caption()->value(),
                'url'  => $url,
                'link'     => $block->link()->value(),
              ],
              'id'   => $block->id(),
              'type' => $block->type()
            ],
            );
            $newBlocks->add($newBlock);
        }
        endforeach;

      $newPage->update([
        'blocks' => $newBlocks->toArray(),
      ]);
    }
  ]
]);