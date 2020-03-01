COPYRIGHT AND DISCLAIMER
========================

Overload! - Mass content creator for demo and testing purposes
Copyright (C) 2011  Nicholas K. Dionysopoulos / AkeebaBackup.com

Modified 2020 George Wilson

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see [the on-line version](http://www.gnu.org/licenses/).

The full text of the license can be found in the LICENSE.txt file inside all of
our ZIP packages.

How to Install
===========================
Run from the root of the repo `zip -r com_overload.zip . -x '*.git*' -x '*.idea*' -x 'README.md'`

Original Source
===========================

Everything is based on the  original GitHub repository at
https://github.com/nikosdion/com_overload

GET INVOLVED
============

Free Software is about Freedom of Choice and collaborating with the global
community to deliver the best software to all users. If you run into any
problem, have written a new/improved feature you want to share with the world,
have any suggestion/comment/wish or if you want to provide additional
documentation or tutorials in any form (text, audio, video, etc) feel free to
contact us by any of the available means. We take user contributions and
requests very seriously. Everything you share back with us, even if it is a bug
report, helps us improving our software.

Get involved now!

CHANGELOG
=========

The Changelog is provided in reverse chronological order.
Legend: # Bug fix     + Addition     - Feature removal     ~ Change    ! Critical bug fix     ^ Minor edit

Version 2.0 (2020)
-----------------------------
    + Change to support Joomla 4 only

Version 1.2 (August 1st, 2011)
-----------------------------
	# Articles not created
	# Existing articles were not removed from the category before creating new ones
	# Articles would not appear properly in the front-end without corresponding assets
	  entries. Reverted to using the Joomla! articles model again, which is slow as
	  hell due to the lft/rgt linked list approach Joomla! is using on the #__assets
	  table.

Version 1.1 (July 30th, 2011)
-----------------------------
	# Categories were not enabled by default
	# Articles were not enabled by default
	~ Remove existing articles in a category before creating new ones
	~ Article titles are now "Overload article 1234 in 1-2-3" so that they are unique
	+ Images in introtext and fulltext
	+ i18n for the component's interface

Version 1.0 (July 29th, 2011)
-----------------------------
	First version
