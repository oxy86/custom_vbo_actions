# Custom Views Bulk Operations actions

This Drupal 10+ module provides example actions for VBO (and drupal's core system via 'Bulk update' field)

The difference is the VBO actions can be preconfigured. 

If you're using the core "Bulk update" field, which many views (i.e commerce order View) use out of the box, you need to create the action as a config entity, in config/install (see example there).

If you're using VBO, you don't need to create a config entity, the module will pick up the action without it, once caches are cleared.

Note: The example Action configuration is only available with VBO. 

@see https://www.drupal.org/docs/contributed-modules/views-bulk-operations-vbo/creating-a-new-action


## Maintainer - Report an Issue

- [Dimitris Kalamaras (oxy86)](https://github.com/oxy86)
