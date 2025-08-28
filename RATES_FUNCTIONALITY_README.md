# Rates Functionality

This document describes the rates functionality that has been implemented for the Laravel 11 project, migrated from Vue to Blade templates with real-time API integration.

## Overview

The rates functionality provides access to IFTA (International Fuel Tax Agreement) rates organized by year and quarter, displaying real-time data fetched from the [IFTA Calculator API](https://ifta-calculator.com/api/demo-rates/2025/3). The system fetches live data and displays it in a table format that matches the original Vue component structure exactly.

## Features

- **Real-Time Data**: Fetches live IFTA rates from external API
- **Quarterly Rate Display**: View rates for specific quarters (Q1-Q4) and years
- **Table Format**: Displays rates in a structured table with Country, State, Year, Quarter, Rate, and Surcharge Rate columns
- **Navigation**: Easy navigation between different quarters and years using the same UI pattern as the Vue component
- **Responsive Design**: Mobile-friendly interface that matches the original Vue styling
- **Multilingual Support**: Full translation support for English, Russian, and Spanish
- **Caching**: Intelligent caching to reduce API calls and improve performance
- **Error Handling**: Graceful fallbacks when API is unavailable

## API Integration

The system integrates with the [IFTA Calculator API](https://ifta-calculator.com/api/demo-rates/{year}/{quarter}) to fetch real-time rate data:

- **Endpoint**: `https://ifta-calculator.com/api/demo-rates/{year}/{quarter}`
- **Example**: `https://ifta-calculator.com/api/demo-rates/2025/3` for Q3 2025
- **Data Format**: JSON response with structured rate information
- **Caching**: 1-hour cache to optimize performance and reduce API calls
- **Fallback**: Graceful handling when API is unavailable

## URL Structure

- **Main Rates Page**: `/rates` - Shows current quarter rates and navigation
- **Specific Quarter**: `/rates/{year}/{quarter}` - Shows detailed rates for a specific period
  - Example: `/rates/2025/3` shows Q3 2025 rates

## Files Created

### Controller
- `app/Http/Controllers/RatesController.php` - Handles all rates-related logic and API integration

### Routes
- Added to `routes/web.php`:
  - `GET /rates` → `rates.index`
  - `GET /rates/{year}/{quarter}` → `rates.show`

### Views
- `resources/views/site/rates/index.blade.php` - Main rates page with table
- `resources/views/site/rates/show.blade.php` - Specific quarter/year rates page

### Navigation
- Added "Rates" link to the main navigation menu

### Language Files
- Added translations to `resources/lang/en.json`, `resources/lang/ru.json`, and `resources/lang/es.json`

### Tests
- `tests/Feature/RatesTest.php` - Feature tests for the rates functionality

## Controller Methods

### `index()`
- Displays the main rates page
- Shows current quarter rates in table format
- Provides navigation to different years and quarters

### `show(int $year, int $quarter)`
- Displays rates for a specific year and quarter
- Validates parameters (year: 2000-2030, quarter: 1-4)
- Provides navigation between periods

### `getRateList(int $year, int $quarter)`
- Fetches data from remote IFTA API
- Implements intelligent caching (1-hour TTL)
- Transforms API response to match expected format
- Handles API errors gracefully with logging

## Data Structure

The controller fetches real data from the API and transforms it to match the expected format:

```php
$rateList = [
    [
        'country' => 'CA',           // Country code (CA for Canada, US for United States)
        'jurisdiction' => 'AB',      // State/Province code
        'year' => 2025,             // Year
        'quarter' => 3,             // Quarter (1-4)
        'value' => '0.36300',       // Rate value (formatted to 5 decimal places)
        'surcharge_value' => '0.00000' // Surcharge rate
    ],
    // ... more entries from API
];
```

## API Response Structure

The system processes the following API response format:

```json
{
    "year": "2025",
    "quarter": "3",
    "data": [
        {
            "id": 71632,
            "country": "CA",
            "jurisdiction": "AB",
            "currency": "USD",
            "fuel_type": 2,
            "value": "0.36300",
            "quarter": 3,
            "year": 2025,
            "q": 20253,
            "surcharge_value": "0.00000",
            "final": 0,
            "created_at": null,
            "updated_at": null
        }
        // ... more entries
    ]
}
```

## Table Columns

The rates are displayed in a table with the following columns:
- **Country**: CA (Canada) or US (United States)
- **State**: State/Province abbreviation (AB, BC, CA, NY, etc.)
- **Year**: The year for the rates
- **Quarter**: The quarter (1-4)
- **Rate**: The main rate value
- **Surcharge Rate**: Additional surcharge if applicable

## Quarter Information

- **Q1**: January to March
- **Q2**: April to June  
- **Q3**: July to September
- **Q4**: October to December

## Navigation Structure

The navigation matches the Vue component exactly:
- **Years**: Vertical list on the left (2014 to current year + 1)
- **Quarters**: Vertical list on the right (4, 3, 2, 1 in reverse order)
- **Selection**: Current selection is highlighted with `rates__link--selected` class
- **Responsive**: On mobile, years are stacked above quarters

## Caching Strategy

The system implements intelligent caching to optimize performance:

- **Cache Key**: `ifta_rates_{year}_{quarter}` (e.g., `ifta_rates_2025_3`)
- **TTL**: 1 hour (3600 seconds)
- **Benefits**: 
  - Reduces API calls
  - Improves page load times
  - Reduces load on external API
  - Provides fallback for offline scenarios

## Error Handling

The system gracefully handles various error scenarios:

- **API Unavailable**: Shows user-friendly message with retry suggestion
- **Network Timeout**: 10-second timeout with fallback
- **Invalid Response**: Logs errors and shows empty state
- **Rate Limiting**: Cached data serves as fallback
- **Logging**: Comprehensive error logging for debugging

## CSS Classes

The styling uses the exact same CSS classes as the Vue component:

- `.rates` - Main container
- `.rates__control` - Navigation control container
- `.rates__link-list` - List of navigation items
- `.rates__link` - Individual navigation item
- `.rates__link--selected` - Selected navigation item
- `.c-link` - Link styling
- `.c-table` - Table styling
- `.c-table__th` - Table header
- `.c-table__td` - Table data cell
- `.c-table__tdrow--striped` - Striped table rows

## Usage Examples

### Accessing Current Rates
Visit `/rates` to see the current quarter's rates in table format.

### Viewing Historical Rates
- `/rates/2024/1` - Q1 2024 rates
- `/rates/2023/4` - Q4 2023 rates
- `/rates/2022/2` - Q2 2022 rates

### Navigation Features
- Click on years to view rates for that year
- Click on quarters to view rates for that quarter
- Current selection is highlighted
- Responsive design adapts to screen size

## Customization

### API Configuration
The API endpoint can be configured by modifying the `getRateList()` method in the controller.

### Caching Configuration
Cache duration can be adjusted by changing the TTL value in the `Cache::remember()` call.

### Error Handling
Custom error messages and fallback behavior can be implemented in the error handling sections.

### Adding New Rate Types
Extend the rates array structure and update the corresponding views.

### Styling
The views use the exact same CSS structure as the Vue component and can be customized by:
- Modifying the CSS classes
- Adding custom CSS
- Updating the layout template

## Dependencies

- Laravel 11
- Bootstrap (already included in the project)
- Laravel Localization (for multi-language support)
- Laravel HTTP Client (for API requests)
- Laravel Cache (for data caching)

## Future Enhancements

- Database integration for storing historical rates
- API endpoints for programmatic access
- Rate comparison tools
- Export functionality (PDF, CSV)
- Historical rate charts and graphs
- Email notifications for rate changes
- Advanced caching strategies
- Rate change monitoring and alerts

## Migration Notes

This functionality was migrated from a Vue component (`resources/assets/Rates.vue`) to Blade templates with the following improvements:

- **Exact visual appearance**: Same CSS classes and styling
- **Same data structure**: Identical table format and navigation
- **Same functionality**: Year/quarter selection and navigation
- **Responsive behavior**: Mobile and desktop layouts match exactly
- **Real-time data**: Live API integration instead of static data
- **Performance**: Intelligent caching and error handling
- **Reliability**: Graceful fallbacks and comprehensive logging

## Notes

- Current implementation fetches real-time data from the IFTA Calculator API
- All rates are displayed in the same format as the original Vue component
- The system validates year and quarter parameters to prevent invalid access
- Full multilingual support is implemented for English, Russian, and Spanish
- The navigation structure and styling exactly matches the Vue component
- Intelligent caching reduces API calls and improves performance
- Comprehensive error handling ensures graceful user experience
- All API interactions are logged for debugging and monitoring
