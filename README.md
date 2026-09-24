# Joomla SobiPro Latest Reviews

Site module for [Joomla](https://www.joomla.org/) that lists the latest entry reviews from [SobiPro Reviews](https://www.sigsiu.net/).

**Requires:** Joomla 3.10 or 4.x / 5.x, SobiPro with the Reviews application, and (optionally) Community Builder for avatars.

## Install

Install `mod_sobipro_latest_reviews_2.0.0.zip` from **System → Install → Extensions**. Create a site module instance and publish it.

Existing sites that used `mod_lidapp_latestreviews` should uninstall the old module first. Settings are not migrated automatically because the element name changed.

## SobiPro title field ID

The module reads the entry title from `#__sobipro_field_data` using a SobiPro field ID (`fid`).

The original 1.0.0 module hard-coded `fid = 1`. That value is correct on sites where the section title/name field happens to be field `1`. On other SobiPro sites the title field can be any ID. If the ID is wrong, the module shows a blank title or the value of another field.

Version 2.0.0 keeps **1** as the default so existing sites do not change behaviour, and exposes the value in the module settings as **SobiPro title field ID**.

### How to find the correct ID

**In SobiPro**

1. Open **Components → SobiPro**.
2. Open the section that stores the reviewed entries.
3. Open **Fields**.
4. Find the title / name field of the entry.
5. Use the field **ID** in the module setting.

**In the database**

Replace `1654` with a real entry `sid`:

```sql
SELECT fid, nid, baseData
FROM #__sobipro_field_data
WHERE sid = 1654
ORDER BY fid;
```

The row whose `baseData` is the public entry title is the ID you need.

You can also list section fields:

```sql
SELECT id, nid, name
FROM #__sobipro_field
WHERE section = <section_id>
ORDER BY id;
```

Use the `id` of the title/name field.

If titles look empty or wrong after install, change this setting. If titles already match the live site, leave it at `1`.

## Repository

Canonical repo: `https://github.com/bazimag/joomla-sobipro-latest-reviews`
