<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Node\Inline\Image;
use League\CommonMark\Node\Inline\Text;
use League\CommonMark\Node\NodeWalker;
use League\CommonMark\Node\Node;

class ProductObserver
{
    



    protected function cleanupUnusedAttachments(Product $product)
    {
        $originalContent = $product->getOriginal('brief_description');
        $newContent = $product->brief_description;

        // Get all attachments from original content
        $originalAttachments = $this->extractImagePaths($originalContent);
        $newAttachments = $this->extractImagePaths($newContent);

        // Find attachments that were in original but not in new content
        $unusedAttachments = array_diff($originalAttachments, $newAttachments);

        // Delete unused attachments
        foreach ($unusedAttachments as $attachment) {
            if (Storage::exists($attachment)) {
                Storage::delete($attachment);
            }
        }
    }

    protected function extractImagePaths(?string $markdown): array
    {
        if (empty($markdown)) {
            return [];
        }

        $paths = [];
        $environment = new \League\CommonMark\Environment\Environment();
        $parser = new \League\CommonMark\Parser\MarkdownParser($environment);
        $document = $parser->parse($markdown);
        $walker = $document->walker();

        while ($event = $walker->next()) {
            $node = $event->getNode();

            if ($node instanceof Image && $event->isEntering()) {
                $path = $node->getUrl();

                // Only process local storage paths
                if (str_starts_with($path, 'storage/attachments/')) {
                    $paths[] = str_replace('storage/', '', $path);
                }
            }
        }

        return $paths;
    }
}
