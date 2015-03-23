Wordpress Theme for Hackathon event
===================================


This is a theme taking inspiration from http://hackforchange.org/ theme (which is also a wordpress theme).

The process behind this theme/plugin is the following:

1- A user registers via the usual registration process (we use buddypress to add user profiles and so on)
2- The user can then submit a project via the usual wordpress UI (a project is a post type)
3- Projects are then reviewed by authors/admin/editors and then put in the right category (subjects/themes/challenges).

Other features are:

1- Organiser/Sponsors/Locations pages
2- Projects can be sorted either by Challenges (subjects) or Locations


This is unfortunately far from finished, but the idea is to have a full process where users are registering and booking 
for the event whilst pre-registering their projects.

Installation
============

This is a usual wordpress install. Make sure that apache rewrite mod is on.

0. Install wordpress the usual way
1. Enable registration and set registered user to project manager
2. Enable all plugins one by one being careful about dependencies (xprofile depends on buddypress, and the hackathon 
theme depends on the plugin)
3. Change theme
4. Configure buddypress by creating the relevant pages and enabling permalinks (any option but the default will do)
Go to Menu (screen option at the top) and check Buddy Press menu to be able to add the links (when logged in)
Remove activity stream
5. Add two menus (logged-in and logged-out) so to have different option for non logged in users and logged in users.

Architecture
============

Hackathon-Plugin: the main entities (project, challenges...). We have defined two taxonomies and linked them to their 
relevant custom info page (challenges-info and locations-info).
We have defined a project_manager role that can only add new projects.

Hackathon-theme: uses hackathon plugin and timber (to use twig templating which is really better). All views are in 
the view folder.


TODO
====
Still a lot to do:

1- Translate ALL language stringss
2- Theme: enhance presentation. This is pretty basic and not finished (project presentation, pages for challenges and locations...)

3- Enable project_managers to select taxonomy
...



