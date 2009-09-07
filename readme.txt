=== Web Fiction Table of Contents Sidebar Widget ===
Contributors: Christopher Clarke
Donate link: http://sorrowfulunfounded.com/wp-toc-widget
Tags: web fiction, widget, table of contents, toc, blook, novel, sidebar
Requires at least: 2.8
Tested up to: 2.8.4
Stable tag: 0.1

This sidebar widget will generate a table of contents from a category of posts 
in chronological order.

== Description ==

This sidebar widget will generate a table of contents from a category of posts. 

It is intended for authors of web fiction but should be useful to anyone using
posts to write a book or similar in a serialised format.

== Installation ==

1. Upload the `toc_widget` directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. The widget will now show up under Appearance/Widgets ready for use.

== Frequently Asked Questions ==

= No questions yet =

None yet. Please post your questions to the Muse's Success Community Forums.
        http://muses-success.info/forums

== Screenshots ==

1. Widget Configuration

== Changelog ==

= 0.1 =
* Initial release.

== Widget Configuration Options ==

The widget has several options which you can use to customise its behaviour. The
following is an outline of these options.

= Title =

By default we name the Table of Contents simply Table of Contents. This isn't
always desirable however, so you can use this option to change Table of Contents
to anything you wish.

= Category Containing Chapters =

The plugin expects you to have a category dedicated to only containing the
chapters of your story/novel/etc. You need to tell the widget from which
category to generate the table of contents.

= Format of Chapter Title =

There are numerous ways authors have of naming their posts. Some use just the
chapter title. Others, use Chapter 33 with no title. Others still will specify
both like 33. Name.

        '=============================================================================
        If you name your posts like this:       | Use this:
        '=============================================================================
        Name of Chapter {ex: Heroes}            | {num}. {title}
        ------------------------------------------------------------------------------
        Chapter NUM (ex: Chapter 33)            | {title}
        ------------------------------------------------------------------------------
        NUM. Title (ex: 33. Heroes)             | {title}
        ------------------------------------------------------------------------------
        Chapter NUM: Title {Chapter 33: Heroes} | You should rename your chapters.
        ------------------------------------------------------------------------------

{title} is the post's title.
{num} is an auto-generated chapter number.

= Display TOC in Chapters Only =

You can choose to only display the table of contents on posts that are a part
of the category specified under Category Containing Chapters. This is especially
useful for authors with multiple stories on a single WordPress install as they
can choose to only display the table of contents related to the chapter
currently being read.

= Use Ordered List =

You should feel comfortable with CSS if you tick this option.

You can choose to use an ordered list rather then the default unordered list. If
you choose this option, you will want to set "Format of Chapter Title" to only
{title}, and probably wish to edit your stylesheet since WordPress themes don't
by default style a sidebar widget that use's the ol tag. 
