<div>
    @if ($aboutPageSettings->active)
        <!-- Hero Section -->
        <div class="hero bg-gradient-to-br from-base-200 to-base-300 py-20">
            <div class="hero-content text-center">
                <div class="max-w-4xl">
                    @if ($aboutPageSettings->title)
                        <h1 class="text-5xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent mb-6">
                            {{ $aboutPageSettings->title }}
                        </h1>
                    @endif
                    <div class="w-24 h-1 bg-gradient-to-r from-primary to-secondary mx-auto rounded-full"></div>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="min-h-screen bg-base-100">
            <div class="container mx-auto px-4 py-16">
                <div class="max-w-4xl mx-auto">
                    @if ($aboutPageSettings->content)
                        <div class="card bg-base-100 shadow-xl border border-base-300">
                            <div class="card-body p-8 lg:p-12">
                                <div class="prose prose-lg max-w-none
                                    prose-headings:text-base-content
                                    prose-p:text-base-content/80
                                    prose-p:leading-relaxed
                                    prose-strong:text-base-content
                                    prose-em:text-base-content/70
                                    prose-blockquote:border-l-primary
                                    prose-blockquote:bg-base-200/50
                                    prose-blockquote:rounded-r-lg
                                    prose-blockquote:py-4
                                    prose-blockquote:px-6
                                    prose-ul:text-base-content/80
                                    prose-ol:text-base-content/80
                                    prose-li:marker:text-primary
                                    prose-a:text-primary
                                    prose-a:no-underline
                                    hover:prose-a:underline
                                    prose-code:bg-base-200
                                    prose-code:px-2
                                    prose-code:py-1
                                    prose-code:rounded
                                    prose-code:text-accent
                                    prose-pre:bg-base-300
                                    prose-pre:border
                                    prose-pre:border-base-content/10
                                    prose-img:rounded-lg
                                    prose-img:shadow-lg
                                    prose-img:border
                                    prose-img:border-base-300
                                    prose-img:mx-auto
                                    prose-img:hover:shadow-xl
                                    prose-img:transition-shadow
                                    prose-img:duration-300
                                    prose-figure:text-center
                                    prose-figcaption:text-base-content/60
                                    prose-figcaption:text-sm
                                    prose-figcaption:mt-2
                                    prose-hr:border-base-content/20
                                    prose-hr:my-8
                                    prose-table:border-collapse
                                    prose-table:border
                                    prose-table:border-base-300
                                    prose-table:rounded-lg
                                    prose-table:overflow-hidden
                                    prose-th:bg-base-200
                                    prose-th:border-b
                                    prose-th:border-base-300
                                    prose-th:font-semibold
                                    prose-td:border-b
                                    prose-td:border-base-300/50
                                    prose-th:px-4
                                    prose-th:py-3
                                    prose-td:px-4
                                    prose-td:py-3">

                                    {!! str($aboutPageSettings->content)->sanitizeHtml() !!}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Decorative Bottom Section -->
        <div class="bg-gradient-to-r from-primary/5 to-secondary/5 py-8">
            <div class="container mx-auto px-4">
                <div class="text-center">
                    <div class="inline-flex items-center gap-2 text-base-content/60">
                        <div class="w-8 h-[1px] bg-gradient-to-r from-transparent to-primary"></div>
                        <span class="text-sm font-medium">Thank you for reading</span>
                        <div class="w-8 h-[1px] bg-gradient-to-l from-transparent to-secondary"></div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
