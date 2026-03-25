# Time Ago Bundle Features

Functional scope for `softspring/time-ago-bundle`.

This file is the functional base for the package documentation. It should describe what the bundle is expected to do for applications and templates, not how the internals are implemented.

## Purpose

- Provide a simple way to render past dates as human-readable relative time.
- Make Twig templates easier to read when showing dates such as activity, notifications, comments, logs, or content updates.

## Main Features

- Expose a Twig filter named `time_ago`.
- Expose a Twig function named `time_ago`.
- Accept a `DateTime` value as input.
- Accept a date string that can be converted into a `DateTime`.
- Render relative past time using a single main unit:
  - seconds
  - minutes
  - hours
  - days
  - months
  - years
- Use Symfony translations so the output follows the active locale.
- Ship ready-to-use translations in English and Spanish.
- Work without extra bundle configuration after installation.

## Expected Usage

- Use in Twig as a filter:

```twig
{{ post.publishedAt|time_ago }}
```

- Use in Twig as a function:

```twig
{{ time_ago(post.publishedAt) }}
```

- Use for user-facing dates such as:
  - last update
  - account activity
  - notification timestamps
  - comments or messages
  - dashboard summaries

## Translation Expectations

- The bundle should provide its own translation domain for relative time messages.
- Applications should be able to override the provided translations with standard Symfony translation overrides.
- The wording should stay short and natural for UI use.

## Input And Output Expectations

- Valid `DateTime` inputs should return a translated relative string.
- Valid date strings should return a translated relative string.
- Invalid non-date inputs should not break template rendering.
- Invalid non-date inputs should return an empty string.
- Invalid non-date inputs may be logged as warnings when a logger is available.

## Extension Expectations

- Applications should be able to customize wording by overriding translations.
- Applications should be able to replace or decorate the helper when they need different formatting rules.
- Applications should be able to replace or decorate the Twig extension if they need a different template API.

## Current Limits

- Focus on past time expressed as "ago" style messages.
- Return only one main time unit, not combined phrases such as "2 days and 3 hours ago".
- Do not provide built-in configuration for thresholds or wording rules.
- Do not provide dedicated support for future dates such as "in 5 minutes".
