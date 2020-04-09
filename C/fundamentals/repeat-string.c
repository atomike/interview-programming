#include <string.h>

char *repeat_str(size_t count, const char *src) {
  int string_length = strlen(src);
  int new_string_length = string_length * count;

  char *new_string = calloc(new_string_length, sizeof(char));

  for(int i=1; i<=count; i++){
    new_string = strcat(new_string, src);
  }

  return new_string;
}
